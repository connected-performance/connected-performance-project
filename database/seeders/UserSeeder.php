<?php

namespace Database\Seeders;

use App\Models\Customer;
use App\Models\Employee;
use App\Models\Role;
use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //

        $user = new User();
        $role = new Role();

        $superAdminRole = $role->create([
            'name'   => 'administrator',
            'status' => true,
        ]);
        foreach ([
                'panel_index',
                'view_file',
                'access_backend',
                'view_customer',
                'create_customer',
                'edit_customer',
                'delete_customer',
                'view_lead',
                'meeting_scheduale',
                'view_referrals',
                'view_form',
                'create_form',
                'edit_form',
                'delete_form',
                'view_form_field',
                'create_from_field',
                'edit_form_field',
                'delete_form_field',
                'copy_form_link',
                'view_form_response',
                'manage_currencies',
                'create_currencies',
                'edit_currencies',
                'delete_currencies',
                'view_administrator',
                'create_administrator',
                'edit_administrator',
                'delete_administrator',
                'view_role',
                'create_role',
                'edit_role',
                'delete_role',
                'view_languages',
                'new_languages',
                'manage_languages',
                'delete_languages',
                'view_templates',
                'view_email_templates',
                'update_email_templates',
                'view_sms_templates',
                'view_whatsap_templates',
                // 'view background_jobs',
                // 'view purchase_code',
                'manage_update_application',
                'manage_maintenance_mode',
                'view_invoice',
                'create_invoice',
                'edit_invoice',
                'delete_invoice',
                'view_servicse',
                'create_servicse',
                'edit_servicse',
                'delete_servicse',
                'view_user',
                'view_permission',
                'view_servicse',
                'view_contract',
                'view_setting',
                'view_account_setting',
                'update_account_setting',
                'account_secuirty_setting',
                'update_secuirty_setting',
                'account_billing_plan_setting',
                'update_billing_plan_setting',
                'account_notificaton_setting',
                'update_notificaton_setting',
                'account_connection_setting',
                'update_connection_setting',
                'performance',
                'reports',
                'plugin',
                'view_admin',
                'view_employee',
                'view_payment',
                'view_system_setting',
                'view_time_zone_setting',
                'view_site_setting',
                 'send-mail'

            ] as $name) {
            $superAdminRole->permissions()->create(['name' => $name]);
        }

          $superAdmin  = $user->create([
            'first_name'=> 'admin',
            // 'role_id' => 1,
            'last_name' => 'admin',
            'username'=>'admin',
            'email'=>'admin@example.com',
            'password'=>Hash::make('123456'),
            'active_portal' => 'admin',
            'is_admin' => true,
            'status' => '1',
            'phone_number' => '+00000000',
            'address' => 'test_address',
            'countrie_id' => 70,
            'state_id' => 1132,
            'locale'            => app()->getLocale(),
            'timezone'          => config('app.timezone'),
        ]);
        $superAdmin->save();
        $superAdmin->roles()->save($superAdminRole);

        $employee_role = $role->create([
                'name'   => 'Employee',
                'status' => true,
                'for_user' => '2',
            ]);
        foreach ([
            'view_form',
            'view_file',
            'create_form',
            'edit_form',
            'delete_form',
            'view_form_field',
            'create_from_field',
            'edit_form_field',
            'delete_form_field',
            'copy_form_link',
            'view_form_response',
            'view_lead',
            'view_file',
            'view_invoice',
            'create_invoice',
            'edit_invoice',
            'delete_invoice',
            'panel_index',
            'access_backend',
            'view_customer' ,
            'view_referrals' ,
            'view_referrals',
            'view_referrals',
            'view_referrals',
            'view_deals',
            'view_payment',
            'send-mail'
        ] as $name) {
            $employee_role->permissions()->create(['name' => $name]);
        }
      $employee = $user->create([
            'first_name' => 'emplayee',
            'last_name' => 'trainer',
            'username' => 'trainer',
            'email' => 'employe@example.com',
            'password' => Hash::make('123456'),
            'active_portal' => 'employee',
            'is_employe' => 1,
            'status' => '1',
            'countrie_id' =>70,
            'state_id' => 1132,
            'citie_id' => 15387,
            'phone_number' => '+00000000',
            'address' => 'test_address',
            'locale'            => app()->getLocale(),
            'timezone'          => config('app.timezone'),
        ]);
        $employee->save();
        $employee->roles()->save($employee_role);

        Employee::create([
            'user_id' =>$employee->id,
            'salary_type' => 'Basic',
            'salary'  => '500',
        ]);

    //    $customer =   $user->create([
    //         'first_name' => 'customer1',
    //         // 'role_id' => 3,
    //         'last_name' => 'Test',
    //         'username' => 'customer1',
    //         'email' => 'hbdeveloper.two@gamil.com',
    //         'password' => Hash::make('123456'),
    //         'active_portal' => 'customer',
    //         'is_customer' => 1,
    //         'countrie_id' => 70,
    //         'state_id' => 1132,
    //         'status' => '1',
    //         'phone_number' => '+00000000',
    //         'address' => 'test_address',
    //         'locale'            => app()->getLocale(),
    //         'timezone'          => config('app.timezone'),
    //     ]);

    //     $customer->save();
    //     $customer =   $user->create([
    //         'first_name' => 'customer2',
    //         // 'role_id' => 3,
    //         'last_name' => 'Test',
    //         'username' => 'customer2',
    //         'email' => 'customer2@gamil.com',
    //         'password' => Hash::make('123456'),
    //         'active_portal' => 'customer',
    //         'is_customer' => 1,
    //         'countrie_id' => 70,
    //         'state_id' => 1132,
    //         'status' => '1',
    //         'phone_number' => '+00000000',
    //         'address' => 'test_address',
    //         'locale'            => app()->getLocale(),
    //         'timezone'          => config('app.timezone'),
    //     ]);

    //     $customer =   $user->create([
    //             'first_name' => 'customer3',
    //             // 'role_id' => 3,
    //             'last_name' => 'Test3',
    //             'username' => 'customer3',
    //             'email' => 'customer3@gamil.com',
    //             'password' => Hash::make('123456'),
    //             'active_portal' => 'customer',
    //             'is_customer' => 1,
    //             'countrie_id' => 70,
    //             'state_id' => 1132,
    //             'status' => '1',
    //             'phone_number' => '+00000000',
    //             'address' => 'test_address',
    //             'locale'            => app()->getLocale(),
    //             'timezone'          => config('app.timezone'),
    //         ]);

    //     $customer->save();
    //     $customer =   $user->create([
    //         'first_name' => 'customer4',
    //         // 'role_id' => 3,
    //         'last_name' => 'Test4',
    //         'username' => 'customer4',
    //         'email' => 'customer4@gamil.com',
    //         'password' => Hash::make('123456'),
    //         'active_portal' => 'customer',
    //         'is_customer' => 1,
    //         'countrie_id' => 70,
    //         'state_id' => 1132,
    //         'status' => '1',
    //         'phone_number' => '+00000000',
    //         'address' => 'test_address',
    //         'locale'            => app()->getLocale(),
    //         'timezone'          => config('app.timezone'),
    //     ]);
    //     $customer->save();

        // Customer::create([
        //     'user_id' => $customer->id,
        //     'status' => '1',
        //     'service' => 'Test Service',
        //     // 'referral_id' => 1,
        //     // 'employee_id' => 2,
        // ]);


    }
}
