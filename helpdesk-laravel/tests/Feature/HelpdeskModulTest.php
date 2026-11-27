<?php

namespace Tests\Feature;

use App\Models\AsetPc;
use App\Models\Departemen;
use App\Models\User;
use Database\Seeders\DatabaseSeeder;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class HelpdeskModulTest extends TestCase
{
    use RefreshDatabase;

    protected function setUp(): void
    {
        parent::setUp();
        $this->seed(DatabaseSeeder::class);
    }

    public function test_seeder_creates_expected_departemen_users_and_aset(): void
    {
        $this->assertDatabaseCount('departemen', 3);
        $this->assertDatabaseCount('users', 3);
        $this->assertDatabaseCount('aset_pc', 8);

        $user = User::where('username', 'user')->firstOrFail();
        $this->assertNotNull($user->departemen_id);
        $this->assertSame('HRD', $user->departemen->kode);
    }

    public function test_guest_can_view_read_only_pages_and_login(): void
    {
        $this->get('/')
            ->assertOk()
            ->assertSee('IT Helpdesk System')
            ->assertSee('Manajemen Aset PC')
            ->assertDontSee('+ Tambah Aset')
            ->assertDontSee('Update Kondisi');

        $this->get('/departemen')
            ->assertOk()
            ->assertSee('Manajemen Departemen')
            ->assertDontSee('+ Tambah Departemen');

        $this->get('/login')
            ->assertOk()
            ->assertSee('Login Pengguna');

        $this->get('/aset/create')->assertRedirect('/login');
        $this->get('/departemen/create')->assertRedirect('/login');
    }

    public function test_login_redirects_to_aset_index_and_shows_role_badge(): void
    {
        $this->post('/login', [
            'username' => 'admin',
            'password' => 'admin123',
        ])->assertRedirect('/');

        $this->get('/')
            ->assertOk()
            ->assertSee('Logout (admin)')
            ->assertSee('admin');
    }

    public function test_user_only_sees_own_departemen_assets_and_cannot_mutate(): void
    {
        $user = User::where('username', 'user')->firstOrFail();
        $hrdAset = AsetPc::where('departemen_id', $user->departemen_id)->firstOrFail();
        $otherAset = AsetPc::where('departemen_id', '!=', $user->departemen_id)->firstOrFail();

        $this->actingAs($user)
            ->get('/')
            ->assertOk()
            ->assertSee($hrdAset->kode_aset)
            ->assertDontSee($otherAset->kode_aset)
            ->assertDontSee('+ Tambah Aset')
            ->assertDontSee('Hapus');

        $this->actingAs($user)->get("/aset/{$hrdAset->id}")->assertOk();
        $this->actingAs($user)->get("/aset/{$otherAset->id}")->assertForbidden();
        $this->actingAs($user)->get('/aset/create')->assertForbidden();
        $this->actingAs($user)->get("/aset/{$hrdAset->id}/kondisi")->assertForbidden();
        $this->actingAs($user)->get('/departemen/create')->assertForbidden();
        $this->actingAs($user)->delete("/aset/{$hrdAset->id}")->assertForbidden();
    }

    public function test_teknisi_can_update_kondisi_and_status_but_cannot_manage_aset_or_departemen(): void
    {
        $teknisi = User::where('username', 'teknisi')->firstOrFail();
        $aset = AsetPc::firstOrFail();

        $this->actingAs($teknisi)
            ->get('/')
            ->assertOk()
            ->assertSee('Update Kondisi')
            ->assertDontSee('+ Tambah Aset')
            ->assertDontSee('Hapus');

        $this->actingAs($teknisi)
            ->get("/aset/{$aset->id}/kondisi")
            ->assertOk()
            ->assertSee('Update Kondisi Aset PC');

        $this->actingAs($teknisi)
            ->patch("/aset/{$aset->id}/kondisi", [
                'kondisi' => 'Perlu Servis',
                'status' => 'Perbaikan',
            ])
            ->assertRedirect('/');

        $this->assertDatabaseHas('aset_pc', [
            'id' => $aset->id,
            'kondisi' => 'Perlu Servis',
            'status' => 'Perbaikan',
        ]);

        $this->actingAs($teknisi)->get('/aset/create')->assertForbidden();
        $this->actingAs($teknisi)->post('/aset', [])->assertForbidden();
        $this->actingAs($teknisi)->delete("/aset/{$aset->id}")->assertForbidden();
        $this->actingAs($teknisi)->get('/departemen/create')->assertForbidden();
    }

    public function test_admin_can_crud_departemen_and_aset_and_cannot_delete_departemen_with_assets(): void
    {
        $admin = User::where('username', 'admin')->firstOrFail();
        $hrd = Departemen::where('kode', 'HRD')->firstOrFail();

        // Cannot delete departemen that still has assets
        $this->actingAs($admin)
            ->delete("/departemen/{$hrd->id}")
            ->assertRedirect('/departemen')
            ->assertSessionHas('error');

        $this->assertDatabaseHas('departemen', ['id' => $hrd->id]);

        // Create & delete empty departemen
        $this->actingAs($admin)
            ->post('/departemen', [
                'kode' => 'IT',
                'nama' => 'IT Support',
                'penanggung_jawab' => 'Dika Pratama',
                'lokasi' => 'Gedung C - Lantai 1',
            ])
            ->assertRedirect('/departemen');

        $itDept = Departemen::where('kode', 'IT')->firstOrFail();

        // Create asset in new departemen (verifying fixed AsetPc::create)
        $this->actingAs($admin)
            ->post('/aset', [
                'kode_aset' => 'AST-IT-001',
                'nama_perangkat' => 'Laptop Teknisi 01',
                'jenis' => 'Laptop',
                'merek' => 'Lenovo ThinkPad X1',
                'spesifikasi' => 'Core i7, 16GB RAM',
                'departemen_id' => $itDept->id,
                'kondisi' => 'Baik',
                'status' => 'Aktif',
                'tanggal_pembelian' => '2025-02-01',
            ])
            ->assertRedirect('/');

        $newAset = AsetPc::where('kode_aset', 'AST-IT-001')->firstOrFail();

        // Delete asset then delete empty departemen
        $this->actingAs($admin)->delete("/aset/{$newAset->id}")->assertRedirect('/');
        $this->actingAs($admin)->delete("/departemen/{$itDept->id}")->assertRedirect('/departemen')->assertSessionHas('success');

        $this->assertDatabaseMissing('departemen', ['id' => $itDept->id]);
    }

    public function test_api_read_filter_and_admin_only_write_endpoints(): void
    {
        $hrd = Departemen::where('kode', 'HRD')->firstOrFail();

        $this->getJson('/api/departemen')
            ->assertOk()
            ->assertJsonCount(3, 'data');

        $this->getJson("/api/aset?departemen_id={$hrd->id}")
            ->assertOk()
            ->assertJsonCount(3, 'data');

        $this->getJson('/api/aset?q=AST-FIN-001')
            ->assertOk()
            ->assertJsonCount(1, 'data')
            ->assertJsonPath('data.0.kode_aset', 'AST-FIN-001');

        $aset = AsetPc::firstOrFail();
        $this->getJson("/api/aset/{$aset->id}")
            ->assertOk()
            ->assertJsonPath('data.kode_aset', $aset->kode_aset);

        // Unauthenticated write -> 401
        $this->postJson('/api/aset', [])->assertUnauthorized();

        // Non-admin write -> 403
        $teknisi = User::where('username', 'teknisi')->firstOrFail();
        $this->actingAs($teknisi)->postJson('/api/aset', [])->assertForbidden();

        // Admin Basic Auth write -> 201
        $this->withBasicAuth('admin', 'admin123')
            ->postJson('/api/aset', [
                'kode_aset' => 'AST-HRD-099',
                'nama_perangkat' => 'PC API Test',
                'jenis' => 'PC',
                'merek' => 'Dell OptiPlex',
                'departemen_id' => $hrd->id,
                'kondisi' => 'Baik',
                'status' => 'Aktif',
            ])
            ->assertCreated()
            ->assertJsonPath('data.kode_aset', 'AST-HRD-099');
    }
}
