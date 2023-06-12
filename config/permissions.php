<?php

return [
    /*
    |--------------------------------------------------------------------------
    | Application Permissions
    |--------------------------------------------------------------------------
    */

    // Dashboard Module
        'access_backend' => [
                'display_name' => 'dashboard',
                'category'     => 'Dashboard',
        ],

        // Form Builder Module
        'view_form'  => [
                'display_name' => 'read',
                'category'     => 'Form Builder',
        ],

        'create_from' => [
                'display_name' => 'create',
                'category'     => 'Form Builder',
        ],

        'edit_from' => [
                'display_name' => 'update',
                'category'     => 'Form Builder',
        ],
        'delete_from' => [
                'display_name' => 'delete',
                'category'     => 'Form Builder',
        ],
        'link_from' => [
                'display_name' => 'copy from link',
                'category'     => 'Form Builder',
        ],
        'view_response_from' => [
                'display_name' => 'view form response',
                'category'     => 'Form Builder',
        ],

        'view_form_fields'  => [
                'display_name' => 'read',
                'category'     => 'Form Fields',
        ],

        'create_form_fields' => [
                'display_name' => 'create',
                'category'     => 'Form Fields',
        ],

        'edit_form_fields' => [
                'display_name' => 'update',
                'category'     => 'Form Fields',
        ],

        'delete_form_fields' => [
                'display_name' => 'delete',
                'category'     => 'Form Fields',
        ],


    // services Module
        'view_servicse'  => [
                'display_name' => 'read',
                'category'     => 'Service',
        ],

        'create_servicse' => [
                'display_name' => 'create',
                'category'     => 'Service',
        ],

        'edit_servicse' => [
                'display_name' => 'update',
                'category'     => 'Service',
        ],

        'delete_servicse' => [
                'display_name' => 'delete',
                'category'     => 'Service',
        ],

      //User Madule
        'view_user'  => [
                'display_name' => 'user',
                'category'     => 'User',
        ],

//Admin Module

        'view_admin'  => [
                'display_name' => 'read',
                'category'     => 'Admin',
        ],

        'create_admin' => [
                'display_name' => 'create',
                'category'     => 'Admin',
        ],

        'edit_admin' => [
                'display_name' => 'update',
                'category'     => 'Admin',
        ],

        'delete_admin' => [
                'display_name' => 'delete',
                'category'     => 'Admin',
        ],

        //Employee Module
        'view_employee'  => [
                'display_name' => 'read',
                'category'     => 'Employee',
        ],

        'create_employee' => [
                'display_name' => 'create',
                'category'     => 'Employee',
        ],

        'edit_employee' => [
                'display_name' => 'update',
                'category'     => 'Employee',
        ],

        'delete_employee' => [
                'display_name' => 'delete',
                'category'     => 'Employee',
        ],

        //customer Module
        'view_customer'  => [
                'display_name' => 'read',
                'category'     => 'Customer',
        ],

        'create_customer' => [
                'display_name' => 'create',
                'category'     => 'Customer',
        ],

        'edit_customer' => [
                'display_name' => 'update',
                'category'     => 'Customer',
        ],

        'delete_customer' => [
                'display_name' => 'delete',
                'category'     => 'Customer',
        ],

        //Role Module
        'view_role'  => [
                'display_name' => 'read',
                'category'     => 'Role',
        ],

        'create_role' => [
                'display_name' => 'create',
                'category'     => 'Role',
        ],

        'edit_role' => [
                'display_name' => 'update',
                'category'     => 'Role',
        ],

        'delete_role' => [
                'display_name' => 'delete',
                'category'     => 'Role',
        ],
        // Permission Module
        // 'view_permission' => [
        //         'display_name' => 'permission',
        //         'category'     => 'Permission',
        // ],
        // Lead Module
        'view_lead' => [
                'display_name' => 'lead',
                'category'     => 'Lead',
        ],
        // view Contract
        'view_contract' => [
                'display_name' => 'contract',
                'category'     => 'Contract',
        ],
        // Invoice Module
       'view_invoice' => [
                'display_name' => 'read',
                'category'     => 'Invoice',
        ],
        'create_invoice' => [
                'display_name' => 'create',
                'category'     => 'Invoice',
        ],

        'edit_invoice' => [
                'display_name' => 'update',
                'category'     => 'Invoice',
        ],

        'delete_invoice' => [
                'display_name' => 'delete',
                'category'     => 'Invoice',
        ],

        //Templates
        'view_templates' => [
                'display_name' => 'read',
                'category'     => 'Email Templates',
        ],

        'view_email_templates' => [
                'display_name' => 'read',
                'category'     => 'Email Templates',
        ],

        'update_email_templates' => [
                'display_name' => 'update',
                'category'     => 'Email Templates',
        ],

        'view_sms_templates' => [
                'display_name' => 'read',
                'category'     => 'Sms Templates',
        ],

        'update_sms_templates' => [
                'display_name' => 'update',
                'category'     => 'Sms Templates',
        ],

        'view_whatsap_templates' => [
                'display_name' => 'read',
                'category'     => 'Whatsap Templates',
        ],

        'update_whatsap_templates' => [
                'display_name' => 'update',
                'category'     => 'Whatsap Templates',
        ],

        //Acount  Settings Module
        'view_account_setting' => [
                'display_name' => 'reed',
                'category'     => 'Account Settings',
        ],

        'update_account_setting' => [
                'display_name' => 'update',
                'category'     => 'Account Settings',
        ],

        'account_secuirty_setting' => [
                'display_name' => 'read',
                'category'     => 'Secuirty Settings',
        ],

        'update_secuirty_setting' => [
                'display_name' => 'update',
                'category'     => 'Secuirty Settings',
        ],

        'account_billing_plan_setting' => [
                'display_name' => 'read',
                'category'     => 'Plan Billing Settings',
        ],
        'update_billing_plan_setting' => [
                'display_name' => 'update',
                'category'     => 'Plan Billing Settings',
        ],


        'account_notificaton_setting' => [
                'display_name' => 'read',
                'category'     => 'Notification Settings',
        ],
        'update_notificaton_setting' => [
                'display_name' => 'update',
                'category'     => 'Notification Settings',
        ],


        'account_connection_setting' => [
                'display_name' => 'read',
                'category'     => 'Account Settings',
        ],

        'update_connection_setting' => [
                'display_name' => 'read',
                'category'     => 'Account Settings',
        ],
        // Settings Module
        'view_setting' => [
                'display_name' => 'view setting',
                'category'     => 'Settings',
        ],
        'system_setting' => [
                'display_name' => 'system',
                'category'     => 'Settings',
        ],

        'time_zone_setting' => [
                'display_name' => 'time zone',
                'category'     => 'Settings',
        ],

        'site_setting' => [
                'display_name' => 'site setting',
                'category'     => 'Settings',
        ],

        //performance
        'performance' => [
                'display_name' => 'performance',
                'category'     => 'Performance',
        ],

        //reports
        'reports' => [
                'display_name' => 'reports',
                'category'     => 'Reports',
        ],

        'plugin' => [
                'display_name' => 'plugin',
                'category'     => 'plugin',
        ],

        'view_payment' => [
                'display_name' => 'payment',
                'category'     => 'payment',
        ],

        //Send Mail
        'send-mail' => [
                'display_name' => 'Send Mail',
                'category' => 'Send Mail',
        ]

];
