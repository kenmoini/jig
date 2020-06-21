<?php

use App\Asset;
use App\Workshop;
use Carbon\Carbon;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

class AssetSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $legacyWorkshops = [
          'agile_integrations_ci',
          'agile_integrations_dev',
          'ansible_automation',
          'ansible_networking',
          'security_containers',
          'containers_101',
          'secure_software_factory',
          'containers_the_hard_way',
          'openshift_101_dcmetromap',
          'openshift_4_101',
          'security_openshift',
          'openshift_service_mesh',
          'rhel_8',
          'selinux_policy'
        ];

        foreach ($legacyWorkshops as $legacyWorkshop) {
          $workshop = Workshop::where('curriculum_slug', $legacyWorkshop)->first();
          if ($workshop) {
            echo 'Adding assets for ' . $workshop->name . "...\n";
            $assetDomainCookie = new Asset;
            $assetDomainCookie->workshop_id = $workshop->id;
            $assetDomainCookie->user_id = 1;
            $assetDomainCookie->created_at = Carbon::now()->toDateTimeString();
            $assetDomainCookie->updated_at = Carbon::now()->toDateTimeString();
            $assetDomainCookie->asset_type = "cookie";
            $assetDomainCookie->name = "Domain Cookie";
            $assetDomainCookie->slug = Str::slug($assetDomainCookie->name);
            $assetDomainCookie->asset_data = json_encode([
              'key' => "domain",
              'default_value' => $workshop->base_domain,
              'domain' => $workshop->base_domain,
              'path' => $workshop->workshop_path,
              'expiration' => 7,
            ]);
            $assetDomainCookie->save();

            $assetWorkshopCookie = new Asset;
            $assetWorkshopCookie->workshop_id = $workshop->id;
            $assetWorkshopCookie->user_id = 1;
            $assetWorkshopCookie->created_at = Carbon::now()->toDateTimeString();
            $assetWorkshopCookie->updated_at = Carbon::now()->toDateTimeString();
            $assetWorkshopCookie->asset_type = "cookie";
            $assetWorkshopCookie->name = "Workshop Cookie";
            $assetWorkshopCookie->slug = Str::slug($assetWorkshopCookie->name);
            $assetWorkshopCookie->asset_data = json_encode([
              'key' => "prefix",
              'default_value' => "",
              'domain' => $workshop->base_domain,
              'path' => $workshop->workshop_path,
              'expiration' => 7,
            ]);
            $assetWorkshopCookie->save();

            $assetUserIDCookie = new Asset;
            $assetUserIDCookie->workshop_id = $workshop->id;
            $assetUserIDCookie->user_id = 1;
            $assetUserIDCookie->created_at = Carbon::now()->toDateTimeString();
            $assetUserIDCookie->updated_at = Carbon::now()->toDateTimeString();
            $assetUserIDCookie->asset_type = "cookie";
            $assetUserIDCookie->name = "User ID Cookie";
            $assetUserIDCookie->slug = Str::slug($assetUserIDCookie->name);
            $assetUserIDCookie->asset_data = json_encode([
              'key' => "userid",
              'default_value' => "[[seat_number]]",
              'domain' => $workshop->base_domain,
              'path' => $workshop->workshop_path,
              'expiration' => 7,
            ]);
            $assetUserIDCookie->save();
          }
        }
    }
}
