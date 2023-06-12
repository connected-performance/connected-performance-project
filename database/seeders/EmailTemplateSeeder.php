<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class EmailTemplateSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $path = 'database/seeders/email_templates.sql';
        DB::unprepared(file_get_contents($path));
//         DB::table('email_templates')->insert([
//             'name' => "Test Email",
//             'slug' => "test-email",
//             'value' => '

//       <table border="0" cellpadding="0" cellspacing="0" width="100%"><tbody><tr><td align="center" style="background-color:#23293f;">
//             <table border="0" cellpadding="0" cellspacing="0" width="480"><tbody><tr><td align="center" valign="top" style="padding:40px 10px 40px 10px;">

//                     </td>
//                 </tr></tbody></table></td>
//     </tr><tr><td style="background-color:#23293f;padding:0px 10px 0px 10px;" align="center">
//             <table border="0" cellpadding="0" cellspacing="0" width="480"><tbody><tr><td align="center" valign="top" style="background-color:#ffffff;padding:40px 20px 20px 20px;color:#111111;font-family:Lato, Helvetica, Arial, sans-serif;font-size:48px;font-weight:400;letter-spacing:4px;line-height:48px;">
//                       <h1 style="font-size:25px;font-weight:400;margin-left:10px;text-align:left;letter-spacing:0px;color:#111111;">Hi, --userName--</h1>
//                     </td>
//                 </tr></tbody></table></td>
//     </tr><tr><td align="center" style="background-color:#f4f4f4;padding:0px 10px 0px 10px;">
//             <table border="0" cellpadding="0" cellspacing="0" width="480"><tbody><tr><td align="left" style="background-color:#ffffff;padding:20px 30px 40px 30px;color:#666666;font-family:Lato, Helvetica, Arial, sans-serif;font-size:18px;font-weight:400;line-height:25px;">
//                   <p style="margin:0;">This is a test email. This is how your clients will receive emails.</p>
//                 </td>
//               </tr><tr><td align="left" style="background-color:#ffffff;">

//                 </td>
//               </tr></tbody></table></td>
//     </tr><tr><td align="center" style="background-color:#f4f4f4;padding:0px 10px 0px 10px;"><br /></td>
//     </tr><tr><td align="center" style="background-color:#f4f4f4;padding:30px 10px 0px 10px;">
//             <table border="0" cellpadding="0" cellspacing="0" width="480"><tbody><tr><td align="center" style="background-color:#C6C2ED;padding:30px 30px 30px 30px;color:#666666;font-family:Lato, Helvetica, Arial, sans-serif;font-size:18px;font-weight:400;line-height:25px;">
//                     <h2 style="font-size:20px;font-weight:400;color:#111111;margin:0;">Need more help?</h2>
//                     <p style="margin:0;"><a href="!siteurl" style="color:#7c72dc;">We’re here, ready to talk</a></p>
//                   </td>
//                 </tr></tbody></table></td>
//     </tr><tr><td align="center" style="background-color:#f4f4f4;padding:0px 10px 0px 10px;">
//             <table border="0" cellpadding="0" cellspacing="0" width="480"><tbody><tr><td align="left" style="background-color:#f4f4f4;padding:0px 30px 30px 30px;color:#666666;font-family:Lato, Helvetica, Arial, sans-serif;font-size:14px;font-weight:400;line-height:18px;">
//                   <p style="margin:0;">You received this email because you requested a password reset. If you did not, <a href="!siteurl" style="color:#111111;font-weight:700;">please contact us.</a>.</p>
//                 </td>
//               </tr><tr><td align="left" style="background-color:#f4f4f4;padding:0px 30px 30px 30px;color:#666666;font-family:Lato, Helvetica, Arial, sans-serif;font-size:14px;font-weight:400;line-height:18px;">
//                   <p style="margin:0;">!address</p>
//                 </td>
//               </tr></tbody></table></td>
//     </tr></tbody></table>'
//         ]);
//         DB::table('email_templates')->insert([
//             'name' => "Notification Email",
//             'slug' => "notification-email",
//             'value' => '<table border="0" width="100%" cellspacing="0" cellpadding="0">
//             <tbody>
//             <tr>
//             <td style="background-color: #23293f;" align="center">
//             <table border="0" width="480" cellspacing="0" cellpadding="0">
//             <tbody>
//             <tr>
//             <td style="padding: 40px 10px 40px 10px;" align="center" valign="top">&nbsp;</td>
//             </tr>
//             </tbody>
//             </table>
//             </td>
//             </tr>
//             <tr>
//             <td style="background-color: #23293f; padding: 0px 10px 0px 10px;" align="center">
//             <table border="0" width="480" cellspacing="0" cellpadding="0">
//             <tbody>
//             <tr>
//             <td style="background-color: #ffffff; padding: 40px 20px 20px 20px; color: #111111; font-family: Lato, Helvetica, Arial, sans-serif; font-size: 48px; font-weight: 400; letter-spacing: 4px; line-height: 48px;" align="center" valign="top">
//             <h1 style="font-size: 25px; font-weight: 400; margin-left: 10px; text-align: left; letter-spacing: 0px; color: #111111;">Hi, --userName--</h1>
//             </td>
//             </tr>
//             </tbody>
//             </table>
//             </td>
//             </tr>
//             <tr>
//             <td style="background-color: #f4f4f4; padding: 0px 10px 0px 10px;" align="center">
//             <table border="0" width="480" cellspacing="0" cellpadding="0">
//             <tbody>
//             <tr>
//             <td style="background-color: #ffffff; padding: 20px 30px 40px 30px; color: #666666; font-family: Lato, Helvetica, Arial, sans-serif; font-size: 18px; font-weight: 400; line-height: 25px;" align="left">
//             <p style="margin: 0;">--NotifocationBody--</p>
//             </td>
//             </tr>
//             <tr>
//             <td style="background-color: #ffffff;" align="left">&nbsp;</td>
//             </tr>
//             </tbody>
//             </table>
//             </td>
//             </tr>
//             <tr>
//             <td style="background-color: #f4f4f4; padding: 0px 10px 0px 10px;" align="center">&nbsp;</td>
//             </tr>
//             <tr>
//             <td style="background-color: #f4f4f4; padding: 30px 10px 0px 10px;" align="center">
//             <table border="0" width="480" cellspacing="0" cellpadding="0">
//             <tbody>
//             <tr>
//             <td style="background-color: #c6c2ed; padding: 30px 30px 30px 30px; color: #666666; font-family: Lato, Helvetica, Arial, sans-serif; font-size: 18px; font-weight: 400; line-height: 25px;" align="center">
//             <h2 style="font-size: 20px; font-weight: 400; color: #111111; margin: 0;">Need more help?</h2>
//             <p style="margin: 0;"><a style="color: #7c72dc;" href="!siteurl">We&rsquo;re here, ready to talk</a></p>
//             </td>
//             </tr>
//             </tbody>
//             </table>
//             </td>
//             </tr>
//             <tr>
//             <td style="background-color: #f4f4f4; padding: 0px 10px 0px 10px;" align="center">
//             <table border="0" width="480" cellspacing="0" cellpadding="0">
//             <tbody>
//             <tr>
//             <td style="background-color: #f4f4f4; padding: 0px 30px 30px 30px; color: #666666; font-family: Lato, Helvetica, Arial, sans-serif; font-size: 14px; font-weight: 400; line-height: 18px;" align="left">
//             <p style="margin: 0;">You received this email because you have selected email as a prefered contract method.</p>
//             </td>
//             </tr>
//             <tr>
//             <td style="background-color: #f4f4f4; padding: 0px 30px 30px 30px; color: #666666; font-family: Lato, Helvetica, Arial, sans-serif; font-size: 14px; font-weight: 400; line-height: 18px;" align="left">&nbsp;</td>
//             </tr>
//             </tbody>
//             </table>
//             </td>
//             </tr>
//             </tbody>
//             </table>'
//         ]);
//         DB::table('email_templates')->insert([
//             'name' => "Template 1",
//             'slug' => "temp1",
//             'value' => '<table border="0" width="100%" cellspacing="0" cellpadding="0">
//             <tbody>
//             <tr>
//             <td style="background-color: #23293f;" align="center">
//             <table border="0" width="480" cellspacing="0" cellpadding="0">
//             <tbody>
//             <tr>
//             <td style="padding: 40px 10px 40px 10px;" align="center" valign="top">&nbsp;</td>
//             </tr>
//             </tbody>
//             </table>
//             </td>
//             </tr>
//             <tr>
//             <td style="background-color: #23293f; padding: 0px 10px 0px 10px;" align="center">
//             <table border="0" width="480" cellspacing="0" cellpadding="0">
//             <tbody>
//             <tr>
//             <td style="background-color: #ffffff; padding: 40px 20px 20px 20px; color: #111111; font-family: Lato, Helvetica, Arial, sans-serif; font-size: 48px; font-weight: 400; letter-spacing: 4px; line-height: 48px;" align="center" valign="top">
//             <h1 style="font-size: 25px; font-weight: 400; margin-left: 10px; text-align: left; letter-spacing: 0px; color: #111111;">Hi, --userName--</h1>
//             </td>
//             </tr>
//             </tbody>
//             </table>
//             </td>
//             </tr>
//             <tr>
//             <td style="background-color: #f4f4f4; padding: 0px 10px 0px 10px;" align="center">
//             <table border="0" width="480" cellspacing="0" cellpadding="0">
//             <tbody>
//             <tr>
//             <td style="background-color: #ffffff; padding: 20px 30px 40px 30px; color: #666666; font-family: Lato, Helvetica, Arial, sans-serif; font-size: 18px; font-weight: 400; line-height: 25px;" align="left">
//             <p style="margin: 0;">--Template1Body--</p>
//             </td>
//             </tr>
//             <tr>
//             <td style="background-color: #ffffff;" align="left">&nbsp;</td>
//             </tr>
//             </tbody>
//             </table>
//             </td>
//             </tr>
//             <tr>
//             <td style="background-color: #f4f4f4; padding: 0px 10px 0px 10px;" align="center">&nbsp;</td>
//             </tr>
//             <tr>
//             <td style="background-color: #f4f4f4; padding: 30px 10px 0px 10px;" align="center">
//             <table border="0" width="480" cellspacing="0" cellpadding="0">
//             <tbody>
//             <tr>
//             <td style="background-color: #c6c2ed; padding: 30px 30px 30px 30px; color: #666666; font-family: Lato, Helvetica, Arial, sans-serif; font-size: 18px; font-weight: 400; line-height: 25px;" align="center">
//             <h2 style="font-size: 20px; font-weight: 400; color: #111111; margin: 0;">Need more help?</h2>
//             <p style="margin: 0;"><a style="color: #7c72dc;" href="!siteurl">We&rsquo;re here, ready to talk</a></p>
//             </td>
//             </tr>
//             </tbody>
//             </table>
//             </td>
//             </tr>
//             <tr>
//             <td style="background-color: #f4f4f4; padding: 0px 10px 0px 10px;" align="center">
//             <table border="0" width="480" cellspacing="0" cellpadding="0">
//             <tbody>
//             <tr>
//             <td style="background-color: #f4f4f4; padding: 0px 30px 30px 30px; color: #666666; font-family: Lato, Helvetica, Arial, sans-serif; font-size: 14px; font-weight: 400; line-height: 18px;" align="left">
//             <p style="margin: 0;">You received this email because you have selected email as a prefered contract method.</p>
//             </td>
//             </tr>
//             <tr>
//             <td style="background-color: #f4f4f4; padding: 0px 30px 30px 30px; color: #666666; font-family: Lato, Helvetica, Arial, sans-serif; font-size: 14px; font-weight: 400; line-height: 18px;" align="left">&nbsp;</td>
//             </tr>
//             </tbody>
//             </table>
//             </td>
//             </tr>
//             </tbody>
//             </table>'
//         ]);
//         DB::table('email_templates')->insert([
//             'name' => "Template 2",
//             'slug' => "temp2",
//             'value' => '<table border="0" width="100%" cellspacing="0" cellpadding="0">
//             <tbody>
//             <tr>
//             <td style="background-color: #23293f;" align="center">
//             <table border="0" width="480" cellspacing="0" cellpadding="0">
//             <tbody>
//             <tr>
//             <td style="padding: 40px 10px 40px 10px;" align="center" valign="top">&nbsp;</td>
//             </tr>
//             </tbody>
//             </table>
//             </td>
//             </tr>
//             <tr>
//             <td style="background-color: #23293f; padding: 0px 10px 0px 10px;" align="center">
//             <table border="0" width="480" cellspacing="0" cellpadding="0">
//             <tbody>
//             <tr>
//             <td style="background-color: #ffffff; padding: 40px 20px 20px 20px; color: #111111; font-family: Lato, Helvetica, Arial, sans-serif; font-size: 48px; font-weight: 400; letter-spacing: 4px; line-height: 48px;" align="center" valign="top">
//             <h1 style="font-size: 25px; font-weight: 400; margin-left: 10px; text-align: left; letter-spacing: 0px; color: #111111;">Hi, --userName--</h1>
//             </td>
//             </tr>
//             </tbody>
//             </table>
//             </td>
//             </tr>
//             <tr>
//             <td style="background-color: #f4f4f4; padding: 0px 10px 0px 10px;" align="center">
//             <table border="0" width="480" cellspacing="0" cellpadding="0">
//             <tbody>
//             <tr>
//             <td style="background-color: #ffffff; padding: 20px 30px 40px 30px; color: #666666; font-family: Lato, Helvetica, Arial, sans-serif; font-size: 18px; font-weight: 400; line-height: 25px;" align="left">
//             <p style="margin: 0;">--Template2Body--</p>
//             </td>
//             </tr>
//             <tr>
//             <td style="background-color: #ffffff;" align="left">&nbsp;</td>
//             </tr>
//             </tbody>
//             </table>
//             </td>
//             </tr>
//             <tr>
//             <td style="background-color: #f4f4f4; padding: 0px 10px 0px 10px;" align="center">&nbsp;</td>
//             </tr>
//             <tr>
//             <td style="background-color: #f4f4f4; padding: 30px 10px 0px 10px;" align="center">
//             <table border="0" width="480" cellspacing="0" cellpadding="0">
//             <tbody>
//             <tr>
//             <td style="background-color: #c6c2ed; padding: 30px 30px 30px 30px; color: #666666; font-family: Lato, Helvetica, Arial, sans-serif; font-size: 18px; font-weight: 400; line-height: 25px;" align="center">
//             <h2 style="font-size: 20px; font-weight: 400; color: #111111; margin: 0;">Need more help?</h2>
//             <p style="margin: 0;"><a style="color: #7c72dc;" href="!siteurl">We&rsquo;re here, ready to talk</a></p>
//             </td>
//             </tr>
//             </tbody>
//             </table>
//             </td>
//             </tr>
//             <tr>
//             <td style="background-color: #f4f4f4; padding: 0px 10px 0px 10px;" align="center">
//             <table border="0" width="480" cellspacing="0" cellpadding="0">
//             <tbody>
//             <tr>
//             <td style="background-color: #f4f4f4; padding: 0px 30px 30px 30px; color: #666666; font-family: Lato, Helvetica, Arial, sans-serif; font-size: 14px; font-weight: 400; line-height: 18px;" align="left">
//             <p style="margin: 0;">You received this email because you have selected email as a prefered contract method.</p>
//             </td>
//             </tr>
//             <tr>
//             <td style="background-color: #f4f4f4; padding: 0px 30px 30px 30px; color: #666666; font-family: Lato, Helvetica, Arial, sans-serif; font-size: 14px; font-weight: 400; line-height: 18px;" align="left">&nbsp;</td>
//             </tr>
//             </tbody>
//             </table>
//             </td>
//             </tr>
//             </tbody>
//             </table>'
//         ]);
//         DB::table('email_templates')->insert([
//             'name' => "Template 3",
//             'slug' => "temp3",
//             'value' => '<table border="0" width="100%" cellspacing="0" cellpadding="0">
//             <tbody>
//             <tr>
//             <td style="background-color: #23293f;" align="center">
//             <table border="0" width="480" cellspacing="0" cellpadding="0">
//             <tbody>
//             <tr>
//             <td style="padding: 40px 10px 40px 10px;" align="center" valign="top">&nbsp;</td>
//             </tr>
//             </tbody>
//             </table>
//             </td>
//             </tr>
//             <tr>
//             <td style="background-color: #23293f; padding: 0px 10px 0px 10px;" align="center">
//             <table border="0" width="480" cellspacing="0" cellpadding="0">
//             <tbody>
//             <tr>
//             <td style="background-color: #ffffff; padding: 40px 20px 20px 20px; color: #111111; font-family: Lato, Helvetica, Arial, sans-serif; font-size: 48px; font-weight: 400; letter-spacing: 4px; line-height: 48px;" align="center" valign="top">
//             <h1 style="font-size: 25px; font-weight: 400; margin-left: 10px; text-align: left; letter-spacing: 0px; color: #111111;">Hi, --userName--</h1>
//             </td>
//             </tr>
//             </tbody>
//             </table>
//             </td>
//             </tr>
//             <tr>
//             <td style="background-color: #f4f4f4; padding: 0px 10px 0px 10px;" align="center">
//             <table border="0" width="480" cellspacing="0" cellpadding="0">
//             <tbody>
//             <tr>
//             <td style="background-color: #ffffff; padding: 20px 30px 40px 30px; color: #666666; font-family: Lato, Helvetica, Arial, sans-serif; font-size: 18px; font-weight: 400; line-height: 25px;" align="left">
//             <p style="margin: 0;">--Template3Body--</p>
//             </td>
//             </tr>
//             <tr>
//             <td style="background-color: #ffffff;" align="left">&nbsp;</td>
//             </tr>
//             </tbody>
//             </table>
//             </td>
//             </tr>
//             <tr>
//             <td style="background-color: #f4f4f4; padding: 0px 10px 0px 10px;" align="center">&nbsp;</td>
//             </tr>
//             <tr>
//             <td style="background-color: #f4f4f4; padding: 30px 10px 0px 10px;" align="center">
//             <table border="0" width="480" cellspacing="0" cellpadding="0">
//             <tbody>
//             <tr>
//             <td style="background-color: #c6c2ed; padding: 30px 30px 30px 30px; color: #666666; font-family: Lato, Helvetica, Arial, sans-serif; font-size: 18px; font-weight: 400; line-height: 25px;" align="center">
//             <h2 style="font-size: 20px; font-weight: 400; color: #111111; margin: 0;">Need more help?</h2>
//             <p style="margin: 0;"><a style="color: #7c72dc;" href="!siteurl">We&rsquo;re here, ready to talk</a></p>
//             </td>
//             </tr>
//             </tbody>
//             </table>
//             </td>
//             </tr>
//             <tr>
//             <td style="background-color: #f4f4f4; padding: 0px 10px 0px 10px;" align="center">
//             <table border="0" width="480" cellspacing="0" cellpadding="0">
//             <tbody>
//             <tr>
//             <td style="background-color: #f4f4f4; padding: 0px 30px 30px 30px; color: #666666; font-family: Lato, Helvetica, Arial, sans-serif; font-size: 14px; font-weight: 400; line-height: 18px;" align="left">
//             <p style="margin: 0;">You received this email because you have selected email as a prefered contract method.</p>
//             </td>
//             </tr>
//             <tr>
//             <td style="background-color: #f4f4f4; padding: 0px 30px 30px 30px; color: #666666; font-family: Lato, Helvetica, Arial, sans-serif; font-size: 14px; font-weight: 400; line-height: 18px;" align="left">&nbsp;</td>
//             </tr>
//             </tbody>
//             </table>
//             </td>
//             </tr>
//             </tbody>
//             </table>'
//         ]);
//         DB::table('email_templates')->insert([
//             'name' => "Team Invitation",
//             'slug' => "team-invitation",
//             'value' => '<table border="0" width="100%" cellspacing="0" cellpadding="0">
//             <tbody>
//             <tr>
//             <td style="background-color: #23293f;" align="center">
//             <table border="0" width="480" cellspacing="0" cellpadding="0">
//             <tbody>
//             <tr>
//             <td style="padding: 40px 10px 40px 10px;" align="center" valign="top">&nbsp;</td>
//             </tr>
//             </tbody>
//             </table>
//             </td>
//             </tr>
//             <tr>
//             <td style="background-color: #23293f; padding: 0px 10px 0px 10px;" align="center">
//             <table border="0" width="480" cellspacing="0" cellpadding="0">
//             <tbody>
//             <tr>
//             <td style="background-color: #ffffff; padding: 40px 20px 20px 20px; color: #111111; font-family: Lato, Helvetica, Arial, sans-serif; font-size: 48px; font-weight: 400; letter-spacing: 4px; line-height: 48px;" align="center" valign="top">
//             <h1 style="font-size: 25px; font-weight: 400; margin-left: 10px; text-align: left; letter-spacing: 0px; color: #111111;">Hi</h1>
//             </td>
//             </tr>
//             </tbody>
//             </table>
//             </td>
//             </tr>
//             <tr>
//             <td style="background-color: #f4f4f4; padding: 0px 10px 0px 10px;" align="center">
//             <table border="0" width="480" cellspacing="0" cellpadding="0">
//             <tbody>
//             <tr>
//             <td style="background-color: #ffffff; padding: 20px 30px 40px 30px; color: #666666; font-family: Lato, Helvetica, Arial, sans-serif; font-size: 18px; font-weight: 400; line-height: 25px;" align="left">
//             <p style="margin: 0;">Welcome to the Agnimble, click the button below to join Agnimble.</p>
//             </td>
//             </tr>
//             <tr>
//             <td style="background-color: #ffffff;" align="left">
//             <table border="0" width="100%" cellspacing="0" cellpadding="0">
//             <tbody>
//             <tr>
//             <td style="background-color: #ffffff; padding: 20px 30px 60px 30px;" align="center">
//             <table border="0" cellspacing="0" cellpadding="0">
//             <tbody>
//             <tr>
//             <td align="center"><a style="font-size: 20px; font-family: Helvetica, Arial, sans-serif; color: #ffffff; text-decoration: none; padding: 15px 25px; border: 1px solid #7c72dc; background-color: #000000;" href="!invitationLink">Join Agnimble</a></td>
//             </tr>
//             </tbody>
//             </table>
//             </td>
//             </tr>
//             </tbody>
//             </table>
//             </td>
//             </tr>
//             </tbody>
//             </table>
//             </td>
//             </tr>
//             <tr>
//             <td style="background-color: #f4f4f4; padding: 0px 10px 0px 10px;" align="center">
//             <table border="0" width="480" cellspacing="0" cellpadding="0">
//             <tbody>
//             <tr>
//             <td style="background-color: #23293f; padding: 40px 30px 20px; font-family: Lato, Helvetica, Arial, sans-serif; font-size: 18px; font-weight: 400; line-height: 25px;" align="left">
//             <h2 style="font-size: 24px; font-weight: 400; margin: 0px;"><span style="color: #ffffff;">Unable to click on the button above?</span></h2>
//             </td>
//             </tr>
//             <tr>
//             <td style="background-color: #23293f; padding: 0px 30px 20px 30px; color: #666666; font-family: Lato, Helvetica, Arial, sans-serif; font-size: 18px; font-weight: 400; line-height: 25px;" align="left">
//             <p style="margin: 0;">Click on the link below or copy/paste in the address bar.</p>
//             </td>
//             </tr>
//             <tr>
//             <td style="background-color: #23293f; padding: 0px 30px 40px; font-family: Lato, Helvetica, Arial, sans-serif; font-size: 18px; font-weight: 400; line-height: 25px;" align="left">
//             <p style="margin: 0px;">!invitationLink</p>
//             </td>
//             </tr>
//             </tbody>
//             </table>
//             </td>
//             </tr>
//             <tr>
//             <td style="background-color: #f4f4f4; padding: 30px 10px 0px 10px;" align="center">
//             <table border="0" width="480" cellspacing="0" cellpadding="0">
//             <tbody>
//             <tr>
//             <td style="background-color: #c6c2ed; padding: 30px 30px 30px 30px; color: #666666; font-family: Lato, Helvetica, Arial, sans-serif; font-size: 18px; font-weight: 400; line-height: 25px;" align="center">
//             <h2 style="font-size: 20px; font-weight: 400; color: #111111; margin: 0;">Need more help?</h2>
//             <p style="margin: 0;"><a style="color: #7c72dc;" href="!siteurl">We&rsquo;re here, ready to talk</a></p>
//             </td>
//             </tr>
//             </tbody>
//             </table>
//             </td>
//             </tr>
//             <tr>
//             <td style="background-color: #f4f4f4; padding: 0px 10px 0px 10px;" align="center">
//             <table border="0" width="480" cellspacing="0" cellpadding="0">
//             <tbody>
//             <tr>
//             <td style="background-color: #f4f4f4; padding: 0px 30px 30px 30px; color: #666666; font-family: Lato, Helvetica, Arial, sans-serif; font-size: 14px; font-weight: 400; line-height: 18px;" align="left">
//             <p style="margin: 0;">You received this email because you requested a password reset. If you did not, <a style="color: #111111; font-weight: bold;" href="!siteurl">please contact us.</a>.</p>
//             </td>
//             </tr>
//             <tr>
//             <td style="background-color: #f4f4f4; padding-top: 0px; padding-right: 30px; padding-bottom: 30px; color: #666666; font-family: Lato, Helvetica, Arial, sans-serif; font-size: 14px; font-weight: 400; line-height: 18px;" align="left">&nbsp;</td>
//             </tr>
//             </tbody>
//             </table>
//             </td>
//             </tr>
//             </tbody>
//             </table>'
//         ]);

//         DB::table('email_templates')->insert([
//             'name' => "Farmer Invitation",
//             'slug' => "farmer-invitation",
//             'value' => '<table border="0" width="100%" cellspacing="0" cellpadding="0">
//             <tbody>
//             <tr>
//             <td style="background-color: #23293f;" align="center">
//             <table border="0" width="480" cellspacing="0" cellpadding="0">
//             <tbody>
//             <tr>
//             <td style="padding: 40px 10px 40px 10px;" align="center" valign="top">&nbsp;</td>
//             </tr>
//             </tbody>
//             </table>
//             </td>
//             </tr>
//             <tr>
//             <td style="background-color: #23293f; padding: 0px 10px 0px 10px;" align="center">
//             <table border="0" width="480" cellspacing="0" cellpadding="0">
//             <tbody>
//             <tr>
//             <td style="background-color: #ffffff; padding: 40px 20px 20px 20px; color: #111111; font-family: Lato, Helvetica, Arial, sans-serif; font-size: 48px; font-weight: 400; letter-spacing: 4px; line-height: 48px;" align="center" valign="top">
//             <h1 style="font-size: 25px; font-weight: 400; margin-left: 10px; text-align: left; letter-spacing: 0px; color: #111111;">Hi FarmerName!</h1>
//             </td>
//             </tr>
//             </tbody>
//             </table>
//             </td>
//             </tr>
//             <tr>
//             <td style="background-color: #f4f4f4; padding: 0px 10px 0px 10px;" align="center">
//             <table border="0" width="480" cellspacing="0" cellpadding="0">
//             <tbody>
//             <tr>
//             <td style="background-color: #ffffff; padding: 20px 30px 40px 30px; color: #666666; font-family: Lato, Helvetica, Arial, sans-serif; font-size: 18px; font-weight: 400; line-height: 25px;" align="left">
//             <p style="margin: 0;">Welcome to the Agnimble, !sender_name Added You As Farmer.</p>
//             <p style="margin: 0;">Your Email is !FarmerEmail and Password is  !FarmerPassword. click the button below to Login Agnimble.</p>
//             </td>
//             </tr>
//             <tr>
//             <td style="background-color: #ffffff;" align="left">
//             <table border="0" width="100%" cellspacing="0" cellpadding="0">
//             <tbody>
//             <tr>
//             <td style="background-color: #ffffff; padding: 20px 30px 60px 30px;" align="center">
//             <table border="0" cellspacing="0" cellpadding="0">
//             <tbody>
//             <tr>
//             <td align="center"><a style="font-size: 20px; font-family: Helvetica, Arial, sans-serif; color: #ffffff; text-decoration: none; padding: 15px 25px; border: 1px solid #7c72dc; background-color: #34c38f;" href="!invitationLink">Login </a></td>
//             </tr>
//             </tbody>
//             </table>
//             </td>
//             </tr>
//             </tbody>
//             </table>
//             </td>
//             </tr>
//             </tbody>
//             </table>
//             </td>
//             </tr>
//             <tr>
//             <td style="background-color: #f4f4f4; padding: 0px 10px 0px 10px;" align="center">
//             <table border="0" width="480" cellspacing="0" cellpadding="0">
//             <tbody>
//             <tr>
//             <td style="background-color: #23293f; padding: 40px 30px 20px; font-family: Lato, Helvetica, Arial, sans-serif; font-size: 18px; font-weight: 400; line-height: 25px;" align="left">
//             <h2 style="font-size: 24px; font-weight: 400; margin: 0px;"><span style="color: #ffffff;">Unable to click on the button above?</span></h2>
//             </td>
//             </tr>
//             <tr>
//             <td style="background-color: #23293f; padding: 0px 30px 20px 30px; color: #666666; font-family: Lato, Helvetica, Arial, sans-serif; font-size: 18px; font-weight: 400; line-height: 25px;" align="left">
//             <p style="margin: 0;">Click on the link below or copy/paste in the address bar.</p>
//             </td>
//             </tr>
//             <tr>
//             <td style="background-color: #23293f; padding: 0px 30px 40px; font-family: Lato, Helvetica, Arial, sans-serif; font-size: 18px; font-weight: 400; line-height: 25px;" align="left">
//             <p style="margin: 0px;">!invitationLink</p>
//             </td>
//             </tr>
//             </tbody>
//             </table>
//             </td>
//             </tr>
//             <tr>
//             <td style="background-color: #f4f4f4; padding: 30px 10px 0px 10px;" align="center">
//             <table border="0" width="480" cellspacing="0" cellpadding="0">
//             <tbody>
//             <tr>
//             <td style="background-color: #c6c2ed; padding: 30px 30px 30px 30px; color: #666666; font-family: Lato, Helvetica, Arial, sans-serif; font-size: 18px; font-weight: 400; line-height: 25px;" align="center">
//             <h2 style="font-size: 20px; font-weight: 400; color: #111111; margin: 0;">Need more help?</h2>
//             <p style="margin: 0;"><a style="color: #7c72dc;" href="!siteurl">We&rsquo;re here, ready to talk</a></p>
//             </td>
//             </tr>
//             </tbody>
//             </table>
//             </td>
//             </tr>
//             <tr>
//             <td style="background-color: #f4f4f4; padding: 0px 10px 0px 10px;" align="center">
//             <table border="0" width="480" cellspacing="0" cellpadding="0">
//             <tbody>
//             <tr>
//             <td style="background-color: #f4f4f4; padding-top: 0px; padding-right: 30px; padding-bottom: 30px; color: #666666; font-family: Lato, Helvetica, Arial, sans-serif; font-size: 14px; font-weight: 400; line-height: 18px;" align="left">&nbsp;</td>
//             </tr>
//             </tbody>
//             </table>
//             </td>
//             </tr>
//             </tbody>
//             </table>'
//         ]);
//         DB::table('email_templates')->insert([
//             'name' => "Partner Invitation",
//             'slug' => "partner-invitation",
//             'value' => '<table border="0" width="100%" cellspacing="0" cellpadding="0">
//             <tbody>
//             <tr>
//             <td style="background-color: #23293f;" align="center">
//             <table border="0" width="480" cellspacing="0" cellpadding="0">
//             <tbody>
//             <tr>
//             <td style="padding: 40px 10px 40px 10px;" align="center" valign="top">&nbsp;</td>
//             </tr>
//             </tbody>
//             </table>
//             </td>
//             </tr>
//             <tr>
//             <td style="background-color: #23293f; padding: 0px 10px 0px 10px;" align="center">
//             <table border="0" width="480" cellspacing="0" cellpadding="0">
//             <tbody>
//             <tr>
//             <td style="background-color: #ffffff; padding: 40px 20px 20px 20px; color: #111111; font-family: Lato, Helvetica, Arial, sans-serif; font-size: 48px; font-weight: 400; letter-spacing: 4px; line-height: 48px;" align="center" valign="top">
//             <h1 style="font-size: 25px; font-weight: 400; margin-left: 10px; text-align: left; letter-spacing: 0px; color: #111111;">Hi PartnerName!</h1>
//             </td>
//             </tr>
//             </tbody>
//             </table>
//             </td>
//             </tr>
//             <tr>
//             <td style="background-color: #f4f4f4; padding: 0px 10px 0px 10px;" align="center">
//             <table border="0" width="480" cellspacing="0" cellpadding="0">
//             <tbody>
//             <tr>
//             <td style="background-color: #ffffff; padding: 20px 30px 40px 30px; color: #666666; font-family: Lato, Helvetica, Arial, sans-serif; font-size: 18px; font-weight: 400; line-height: 25px;" align="left">
//             <p style="margin: 0;">Welcome to the Agnimble, !sender_name Added You As Partner.</p>
//             <p style="margin: 0;">Your Email is !PartnerEmail and Password is  !PartnerPassword. click the button below to Login Agnimble.</p>
//             </td>
//             </tr>
//             <tr>
//             <td style="background-color: #ffffff;" align="left">
//             <table border="0" width="100%" cellspacing="0" cellpadding="0">
//             <tbody>
//             <tr>
//             <td style="background-color: #ffffff; padding: 20px 30px 60px 30px;" align="center">
//             <table border="0" cellspacing="0" cellpadding="0">
//             <tbody>
//             <tr>
//             <td align="center"><a style="font-size: 20px; font-family: Helvetica, Arial, sans-serif; color: #ffffff; text-decoration: none; padding: 15px 25px; border: 1px solid #7c72dc; background-color: #34c38f;" href="!invitationLink">Login </a></td>
//             </tr>
//             </tbody>
//             </table>
//             </td>
//             </tr>
//             </tbody>
//             </table>
//             </td>
//             </tr>
//             </tbody>
//             </table>
//             </td>
//             </tr>
//             <tr>
//             <td style="background-color: #f4f4f4; padding: 0px 10px 0px 10px;" align="center">
//             <table border="0" width="480" cellspacing="0" cellpadding="0">
//             <tbody>
//             <tr>
//             <td style="background-color: #23293f; padding: 40px 30px 20px; font-family: Lato, Helvetica, Arial, sans-serif; font-size: 18px; font-weight: 400; line-height: 25px;" align="left">
//             <h2 style="font-size: 24px; font-weight: 400; margin: 0px;"><span style="color: #ffffff;">Unable to click on the button above?</span></h2>
//             </td>
//             </tr>
//             <tr>
//             <td style="background-color: #23293f; padding: 0px 30px 20px 30px; color: #666666; font-family: Lato, Helvetica, Arial, sans-serif; font-size: 18px; font-weight: 400; line-height: 25px;" align="left">
//             <p style="margin: 0;">Click on the link below or copy/paste in the address bar.</p>
//             </td>
//             </tr>
//             <tr>
//             <td style="background-color: #23293f; padding: 0px 30px 40px; font-family: Lato, Helvetica, Arial, sans-serif; font-size: 18px; font-weight: 400; line-height: 25px;" align="left">
//             <p style="margin: 0px;">!invitationLink</p>
//             </td>
//             </tr>
//             </tbody>
//             </table>
//             </td>
//             </tr>
//             <tr>
//             <td style="background-color: #f4f4f4; padding: 30px 10px 0px 10px;" align="center">
//             <table border="0" width="480" cellspacing="0" cellpadding="0">
//             <tbody>
//             <tr>
//             <td style="background-color: #c6c2ed; padding: 30px 30px 30px 30px; color: #666666; font-family: Lato, Helvetica, Arial, sans-serif; font-size: 18px; font-weight: 400; line-height: 25px;" align="center">
//             <h2 style="font-size: 20px; font-weight: 400; color: #111111; margin: 0;">Need more help?</h2>
//             <p style="margin: 0;"><a style="color: #7c72dc;" href="!siteurl">We&rsquo;re here, ready to talk</a></p>
//             </td>
//             </tr>
//             </tbody>
//             </table>
//             </td>
//             </tr>
//             <tr>
//             <td style="background-color: #f4f4f4; padding: 0px 10px 0px 10px;" align="center">
//             <table border="0" width="480" cellspacing="0" cellpadding="0">
//             <tbody>
//             <tr>
//             <td style="background-color: #f4f4f4; padding-top: 0px; padding-right: 30px; padding-bottom: 30px; color: #666666; font-family: Lato, Helvetica, Arial, sans-serif; font-size: 14px; font-weight: 400; line-height: 18px;" align="left">&nbsp;</td>
//             </tr>
//             </tbody>
//             </table>
//             </td>
//             </tr>
//             </tbody>
//             </table>'
//         ]);

//         DB::table('email_templates')->insert([
//             'name' => "Partner Invitation",
//             'slug' => "partner-invitation2",
//             'value' => '<table border="0" width="100%" cellspacing="0" cellpadding="0">
//             <tbody>
//             <tr>
//             <td style="background-color: #23293f;" align="center">
//             <table border="0" width="480" cellspacing="0" cellpadding="0">
//             <tbody>
//             <tr>
//             <td style="padding: 40px 10px 40px 10px;" align="center" valign="top">&nbsp;</td>
//             </tr>
//             </tbody>
//             </table>
//             </td>
//             </tr>
//             <tr>
//             <td style="background-color: #23293f; padding: 0px 10px 0px 10px;" align="center">
//             <table border="0" width="480" cellspacing="0" cellpadding="0">
//             <tbody>
//             <tr>
//             <td style="background-color: #ffffff; padding: 40px 20px 20px 20px; color: #111111; font-family: Lato, Helvetica, Arial, sans-serif; font-size: 48px; font-weight: 400; letter-spacing: 4px; line-height: 48px;" align="center" valign="top">
//             <h1 style="font-size: 25px; font-weight: 400; margin-left: 10px; text-align: left; letter-spacing: 0px; color: #111111;">Hi PartnerName!</h1>
//             </td>
//             </tr>
//             </tbody>
//             </table>
//             </td>
//             </tr>
//             <tr>
//             <td style="background-color: #f4f4f4; padding: 0px 10px 0px 10px;" align="center">
//             <table border="0" width="480" cellspacing="0" cellpadding="0">
//             <tbody>
//             <tr>
//             <td style="background-color: #ffffff; padding: 20px 30px 40px 30px; color: #666666; font-family: Lato, Helvetica, Arial, sans-serif; font-size: 18px; font-weight: 400; line-height: 25px;" align="left">
//             <p style="margin: 0;">Welcome to the Agnimble, !sender_name Added You As Partner.</p>
//             <p style="margin: 0;"> click the button below to Login Agnimble.</p>
//             </td>
//             </tr>
//             <tr>
//             <td style="background-color: #ffffff;" align="left">
//             <table border="0" width="100%" cellspacing="0" cellpadding="0">
//             <tbody>
//             <tr>
//             <td style="background-color: #ffffff; padding: 20px 30px 60px 30px;" align="center">
//             <table border="0" cellspacing="0" cellpadding="0">
//             <tbody>
//             <tr>
//             <td align="center"><a style="font-size: 20px; font-family: Helvetica, Arial, sans-serif; color: #ffffff; text-decoration: none; padding: 15px 25px; border: 1px solid #7c72dc; background-color: #34c38f;" href="!invitationLink">Login </a></td>
//             </tr>
//             </tbody>
//             </table>
//             </td>
//             </tr>
//             </tbody>
//             </table>
//             </td>
//             </tr>
//             </tbody>
//             </table>
//             </td>
//             </tr>
//             <tr>
//             <td style="background-color: #f4f4f4; padding: 0px 10px 0px 10px;" align="center">
//             <table border="0" width="480" cellspacing="0" cellpadding="0">
//             <tbody>
//             <tr>
//             <td style="background-color: #23293f; padding: 40px 30px 20px; font-family: Lato, Helvetica, Arial, sans-serif; font-size: 18px; font-weight: 400; line-height: 25px;" align="left">
//             <h2 style="font-size: 24px; font-weight: 400; margin: 0px;"><span style="color: #ffffff;">Unable to click on the button above?</span></h2>
//             </td>
//             </tr>
//             <tr>
//             <td style="background-color: #23293f; padding: 0px 30px 20px 30px; color: #666666; font-family: Lato, Helvetica, Arial, sans-serif; font-size: 18px; font-weight: 400; line-height: 25px;" align="left">
//             <p style="margin: 0;">Click on the link below or copy/paste in the address bar.</p>
//             </td>
//             </tr>
//             <tr>
//             <td style="background-color: #23293f; padding: 0px 30px 40px; font-family: Lato, Helvetica, Arial, sans-serif; font-size: 18px; font-weight: 400; line-height: 25px;" align="left">
//             <p style="margin: 0px;">!invitationLink</p>
//             </td>
//             </tr>
//             </tbody>
//             </table>
//             </td>
//             </tr>
//             <tr>
//             <td style="background-color: #f4f4f4; padding: 30px 10px 0px 10px;" align="center">
//             <table border="0" width="480" cellspacing="0" cellpadding="0">
//             <tbody>
//             <tr>
//             <td style="background-color: #c6c2ed; padding: 30px 30px 30px 30px; color: #666666; font-family: Lato, Helvetica, Arial, sans-serif; font-size: 18px; font-weight: 400; line-height: 25px;" align="center">
//             <h2 style="font-size: 20px; font-weight: 400; color: #111111; margin: 0;">Need more help?</h2>
//             <p style="margin: 0;"><a style="color: #7c72dc;" href="!siteurl">We&rsquo;re here, ready to talk</a></p>
//             </td>
//             </tr>
//             </tbody>
//             </table>
//             </td>
//             </tr>
//             <tr>
//             <td style="background-color: #f4f4f4; padding: 0px 10px 0px 10px;" align="center">
//             <table border="0" width="480" cellspacing="0" cellpadding="0">
//             <tbody>
//             <tr>
//             <td style="background-color: #f4f4f4; padding-top: 0px; padding-right: 30px; padding-bottom: 30px; color: #666666; font-family: Lato, Helvetica, Arial, sans-serif; font-size: 14px; font-weight: 400; line-height: 18px;" align="left">&nbsp;</td>
//             </tr>
//             </tbody>
//             </table>
//             </td>
//             </tr>
//             </tbody>
//             </table>'
//         ]);

//         DB::table('email_templates')->insert([
//             'name' => "Forgot Password",
//             'slug' => "forgot-password",
//             'value' => '<table border="0" cellpadding="0" cellspacing="0" width="100%"><tbody><tr><td align="center" style="background-color:#23293f;">
//             <table border="0" cellpadding="0" cellspacing="0" width="480"><tbody><tr><td align="center" valign="top" style="padding:40px 10px 40px 10px;">

//                     </td>
//                 </tr></tbody></table></td>
//     </tr><tr><td style="background-color:#23293f;padding:0px 10px 0px 10px;" align="center">
//             <table border="0" cellpadding="0" cellspacing="0" width="480"><tbody><tr><td align="center" valign="top" style="background-color:#ffffff;padding:40px 20px 20px 20px;color:#111111;font-family:Lato, Helvetica, Arial, sans-serif;font-size:48px;font-weight:400;letter-spacing:4px;line-height:48px;">
//                       <h1 style="font-size:25px;font-weight:400;margin-left:10px;text-align:left;letter-spacing:0px;color:#111111;">Hi !clientName,</h1>
//                     </td>
//                 </tr></tbody></table></td>
//     </tr><tr><td align="center" style="background-color:#f4f4f4;padding:0px 10px 0px 10px;">
//             <table border="0" cellpadding="0" cellspacing="0" width="480"><tbody><tr><td align="left" style="background-color:#ffffff;padding:20px 30px 40px 30px;color:#666666;font-family:Lato, Helvetica, Arial, sans-serif;font-size:18px;font-weight:400;line-height:25px;">
//                   <p style="margin:0;">Resetting your password is easy. Just press the button below and follow the instructions. Well have you up and running in no time. </p>
//                 </td>
//               </tr><tr><td align="left" style="background-color:#ffffff;">
//                   <table width="100%" border="0" cellspacing="0" cellpadding="0"><tbody><tr><td align="center" style="background-color:#ffffff;padding:20px 30px 60px 30px;">
//                         <table border="0" cellspacing="0" cellpadding="0"><tbody><tr><td align="center"><a href="!resetLink" style="font-size:20px;font-family:Helvetica, Arial, sans-serif;color:rgb(255,255,255);text-decoration:none;padding:15px 25px;border:1px solid rgb(124,114,220);background-color:rgb(0,0,0);">Reset Password</a></td>
//                           </tr></tbody></table></td>
//                     </tr></tbody></table></td>
//               </tr></tbody></table></td>
//     </tr><tr><td align="center" style="background-color:#f4f4f4;padding:0px 10px 0px 10px;">
//             <table border="0" cellpadding="0" cellspacing="0" width="480"><tbody><tr><td align="left" style="background-color:rgb(35,41,63);padding:40px 30px 20px;font-family:Lato, Helvetica, Arial, sans-serif;font-size:18px;font-weight:400;line-height:25px;">
//                     <h2 style="font-size:24px;font-weight:400;margin:0px;"><span style="color:rgb(255,255,255);">Unable to click on the button above?</span></h2>
//                   </td>
//                 </tr><tr><td align="left" style="background-color:#23293f;padding:0px 30px 20px 30px;color:#666666;font-family:Lato, Helvetica, Arial, sans-serif;font-size:18px;font-weight:400;line-height:25px;">
//                     <p style="margin:0;">Click on the link below or copy/paste in the address bar.</p>
//                   </td>
//                 </tr><tr><td align="left" style="background-color:rgb(35,41,63);padding:0px 30px 40px;font-family:Lato, Helvetica, Arial, sans-serif;font-size:18px;font-weight:400;line-height:25px;">
//                     <p style="margin:0px;"><a href="!resetLink"><span style="text-decoration:underline;color:rgb(255,255,255);">!resetLink</span></a></p>
//                   </td>
//                 </tr></tbody></table></td>
//     </tr><tr><td align="center" style="background-color:#f4f4f4;padding:30px 10px 0px 10px;">
//             <table border="0" cellpadding="0" cellspacing="0" width="480"><tbody><tr><td align="center" style="background-color:#C6C2ED;padding:30px 30px 30px 30px;color:#666666;font-family:Lato, Helvetica, Arial, sans-serif;font-size:18px;font-weight:400;line-height:25px;">
//                     <h2 style="font-size:20px;font-weight:400;color:#111111;margin:0;">Need more help?</h2>
//                     <p style="margin:0;"><a href="!siteurl" style="color:#7c72dc;">We’re here, ready to talk</a></p>
//                   </td>
//                 </tr></tbody></table></td>
//     </tr><tr><td align="center" style="background-color:#f4f4f4;padding:0px 10px 0px 10px;">
//             <table border="0" cellpadding="0" cellspacing="0" width="480"><tbody><tr><td align="left" style="background-color:#f4f4f4;padding:0px 30px 30px 30px;color:#666666;font-family:Lato, Helvetica, Arial, sans-serif;font-size:14px;font-weight:400;line-height:18px;">
//                   <p style="margin:0;">You received this email because you requested a password reset. If you did not, <a href="!siteurl" style="color:#111111;font-weight:700;">please contact us.</a>.</p>
//                 </td>
//               </tr><tr><td align="left" style="background-color:#f4f4f4;padding:0px 30px 30px 30px;color:#666666;font-family:Lato, Helvetica, Arial, sans-serif;font-size:14px;font-weight:400;line-height:18px;">
//                   <p style="margin:0;">!address</p>
//                 </td>
//               </tr></tbody></table></td>
//     </tr></tbody></table>'
//         ]);

//         DB::table('email_templates')->insert([
//             'name' => "Account update",
//             'slug' => "account-update",
//             'value' => '<table border="0" cellpadding="0" cellspacing="0" width="100%">

//     <tbody><tr>
//         <td align="center" style="background-color:#23293f;">
//             <table border="0" cellpadding="0" cellspacing="0" width="480">
//                 <tbody><tr>
//                     <td align="center" valign="top" style="padding:40px 10px 40px 10px;">

//                     </td>
//                 </tr>
//             </tbody></table>
//         </td>
//     </tr>

//     <tr>
//         <td style="background-color:#23293f;padding:0px 10px 0px 10px;" align="center">
//             <table border="0" cellpadding="0" cellspacing="0" width="480">
//                 <tbody><tr>
//                     <td align="center" valign="top" style="background-color:#ffffff;padding:40px 20px 20px 20px;color:#111111;font-family:Lato, Helvetica, Arial, sans-serif;font-size:48px;font-weight:400;letter-spacing:4px;line-height:48px;">
//                       <h1 style="font-size:25px;font-weight:400;margin-left:10px;text-align:left;letter-spacing:0px;color:#111111;">Hi !clientName,</h1>
//                     </td>
//                 </tr>
//             </tbody></table>
//         </td>
//     </tr>

//     <tr>
//         <td align="center" style="background-color:#f4f4f4;padding:0px 10px 0px 10px;">
//             <table border="0" cellpadding="0" cellspacing="0" width="480">

//               <tbody><tr>
//                 <td align="left" style="background-color:#ffffff;padding:20px 30px 40px 30px;color:#666666;font-family:Lato, Helvetica, Arial, sans-serif;font-size:18px;font-weight:400;line-height:25px;"><p style="margin:0;">Your payment account has been updated. If this was not you, kindly contact support as soon as possible. </p>
//                 </td>
//               </tr>

//               <tr>
//                 <td align="left" style="background-color:#ffffff;">

//                 </td>
//               </tr>
//             </tbody></table>
//         </td>
//     </tr>

//     <tr>
//         <td align="center" style="background-color:#f4f4f4;padding:0px 10px 0px 10px;"><br>
//         </td>
//     </tr>

//     <tr>
//         <td align="center" style="background-color:#f4f4f4;padding:30px 10px 0px 10px;">
//             <table border="0" cellpadding="0" cellspacing="0" width="480">

//                 <tbody><tr>
//                   <td align="center" style="background-color:#C6C2ED;padding:30px 30px 30px 30px;color:#666666;font-family:Lato, Helvetica, Arial, sans-serif;font-size:18px;font-weight:400;line-height:25px;">
//                     <h2 style="font-size:20px;font-weight:400;color:#111111;margin:0;">Need more help?</h2>
//                     <p style="margin:0;"><a href="!siteurl" style="color:#7c72dc;">We’re here, ready to talk</a></p>
//                   </td>
//                 </tr>
//             </tbody></table>
//         </td>
//     </tr>

//     <tr>
//         <td align="center" style="background-color:#f4f4f4;padding:0px 10px 0px 10px;">
//             <table border="0" cellpadding="0" cellspacing="0" width="480">

//               <tbody><tr>
//                 <td align="left" style="background-color:#f4f4f4;padding:0px 30px 30px 30px;color:#666666;font-family:Lato, Helvetica, Arial, sans-serif;font-size:14px;font-weight:400;line-height:18px;">
//                   <p style="margin:0;">You received this email because your payment information was changed. If you did not, <span style="color:#111111;"><b>please contact us.</b></span>.</p>
//                 </td>
//               </tr>

//               <tr>
//                 <td align="left" style="background-color:#f4f4f4;padding:0px 30px 30px 30px;color:#666666;font-family:Lato, Helvetica, Arial, sans-serif;font-size:14px;font-weight:400;line-height:18px;">
//                   <p style="margin:0;">!address</p>
//                 </td>
//               </tr>
//             </tbody></table>
//         </td>
//     </tr>
        // </tbody></table>'
//         ]);
//         $value = '<table border="0" width="100%" cellspacing="0" cellpadding="0">
//       <tbody>
//       <tr>
//       <td style="background-color: #23293f;" align="center">
//       <table border="0" width="480" cellspacing="0" cellpadding="0">
//       <tbody>
//       <tr>
//       <td style="padding: 40px 10px 40px 10px;" align="center" valign="top">&nbsp;</td>
//       </tr>
//       </tbody>
//       </table>
//       </td>
//       </tr>
//       <tr>
//       <td style="background-color: #23293f; padding: 0px 10px 0px 10px;" align="center">
//       <table border="0" width="480" cellspacing="0" cellpadding="0">
//       <tbody>
//       <tr>
//       <td style="background-color: #ffffff; padding: 40px 20px 20px 20px; color: #111111; font-family: Lato, Helvetica, Arial, sans-serif; font-size: 48px; font-weight: 400; letter-spacing: 4px; line-height: 48px;" align="center" valign="top">
//       <h1 style="font-size: 25px; font-weight: 400; margin-left: 10px; text-align: left; letter-spacing: 0px; color: #111111;">Hi {user_name},</h1>
//       </td>
//       </tr>
//       </tbody>
//       </table>
//       </td>
//       </tr>
//       <tr>
//       <td style="background-color: #f4f4f4; padding: 0px 10px 0px 10px;" align="center">
//       <table border="0" width="480" cellspacing="0" cellpadding="0">
//       <tbody>
//       <tr>
//       <td style="background-color: #ffffff; padding: 20px 30px 40px 30px; color: #666666; font-family: Lato, Helvetica, Arial, sans-serif; font-size: 18px; font-weight: 400; line-height: 25px;" align="left">
//       <p style="margin: 0;">{sender_name} invite you to join AGNimble.</p>
//       <p style="margin: 0;"><a title="Join AGNimble" href="{register_link}" target="_blank" rel="noopener">click here</a>&nbsp; or use following link to join AGNimble.</p>
//       <p style="margin: 0;"><a title="Join AGNimble" href="{register_link}" target="_blank" rel="noopener">{register_link}</a></p>
//       </td>
//       </tr>
//       <tr>
//       <td style="background-color: #ffffff;" align="left">&nbsp;</td>
//       </tr>
//       </tbody>
//       </table>
//       </td>
//       </tr>
//       <tr>
//       <td style="background-color: #f4f4f4; padding: 0px 10px 0px 10px;" align="center">&nbsp;</td>
//       </tr>
//       <tr>
//       <td style="background-color: #f4f4f4; padding: 30px 10px 0px 10px;" align="center">
//       <table border="0" width="480" cellspacing="0" cellpadding="0">
//       <tbody>
//       <tr>
//       <td style="background-color: #c6c2ed; padding: 30px 30px 30px 30px; color: #666666; font-family: Lato, Helvetica, Arial, sans-serif; font-size: 18px; font-weight: 400; line-height: 25px;" align="center">
//       <h2 style="font-size: 20px; font-weight: 400; color: #111111; margin: 0;">Need more help?</h2>
//       <p style="margin: 0;"><a style="color: #7c72dc;" href="!siteurl">We&rsquo;re here, ready to talk</a></p>
//       </td>
//       </tr>
//       </tbody>
//       </table>
//       </td>
//       </tr>
//       <tr>
//       <td style="background-color: #f4f4f4; padding: 0px 10px 0px 10px;" align="center">
//       <table border="0" width="480" cellspacing="0" cellpadding="0">
//       <tbody>
//       <tr>
//       <td style="background-color: #f4f4f4; padding: 0px 30px 30px 30px; color: #666666; font-family: Lato, Helvetica, Arial, sans-serif; font-size: 14px; font-weight: 400; line-height: 18px;" align="left">
//       <p style="margin: 0;">You received this email because you requested a password reset. If you did not, <a style="color: #111111; font-weight: bold;" href="!siteurl">please contact us.</a>.</p>
//       </td>
//       </tr>
//       <tr>
//       <td style="background-color: #f4f4f4; padding: 0px 30px 30px 30px; color: #666666; font-family: Lato, Helvetica, Arial, sans-serif; font-size: 14px; font-weight: 400; line-height: 18px;" align="left">
//       <p style="margin: 0;">!address</p>
//       </td>
//       </tr>
//       </tbody>
//       </table>
//       </td>
//       </tr>
//       </tbody>
//       </table>';
//         DB::table('email_templates')->insert([
//             'slug' => 'buyer-invitation',
//             'name' => 'Invitation',
//             'value' => $value
//         ]);

//         $value = '<table border="0" width="100%" cellspacing="0" cellpadding="0">
//       <tbody>
//       <tr>
//       <td style="background-color: #23293f;" align="center">
//       <table border="0" width="480" cellspacing="0" cellpadding="0">
//       <tbody>
//       <tr>
//       <td style="padding: 40px 10px 40px 10px;" align="center" valign="top">&nbsp;</td>
//       </tr>
//       </tbody>
//       </table>
//       </td>
//       </tr>
//       <tr>
//       <td style="background-color: #23293f; padding: 0px 10px 0px 10px;" align="center">
//       <table border="0" width="480" cellspacing="0" cellpadding="0">
//       <tbody>
//       <tr>
//       <td style="background-color: #ffffff; padding: 40px 20px 20px 20px; color: #111111; font-family: Lato, Helvetica, Arial, sans-serif; font-size: 48px; font-weight: 400; letter-spacing: 4px; line-height: 48px;" align="center" valign="top">
//       <h1 style="font-size: 25px; font-weight: 400; margin-left: 10px; text-align: left; letter-spacing: 0px; color: #111111;">Verify Email</h1>
//       </td>
//       </tr>
//       </tbody>
//       </table>
//       </td>
//       </tr>
//       <tr>
//       <td style="background-color: #f4f4f4; padding: 0px 10px 0px 10px;" align="center">
//       <table border="0" width="480" cellspacing="0" cellpadding="0">
//       <tbody>
//       <tr>
//       <td style="background-color: #ffffff; padding: 20px 30px 40px 30px; color: #666666; font-family: Lato, Helvetica, Arial, sans-serif; font-size: 18px; font-weight: 400; line-height: 25px;" align="left">
//       <p style="margin: 0;">verify your account is easy. Just press the button below and follow the instructions. Well have you up and running in no time.</p>
//       </td>
//       </tr>
//       <tr>
//       <td style="background-color: #ffffff;" align="left">
//       <table border="0" width="100%" cellspacing="0" cellpadding="0">
//       <tbody>
//       <tr>
//       <td style="background-color: #ffffff; padding: 20px 30px 60px 30px;" align="center">
//       <table border="0" cellspacing="0" cellpadding="0">
//       <tbody>
//       <tr>
//       <td align="center"><a style="font-size: 20px; font-family: Helvetica, Arial, sans-serif; color: #ffffff; text-decoration: none; padding: 15px 25px; border: 1px solid #7c72dc; background-color: #000000;" href="!verifyLink">Verify Email</a></td>
//       </tr>
//       </tbody>
//       </table>
//       </td>
//       </tr>
//       </tbody>
//       </table>
//       </td>
//       </tr>
//       </tbody>
//       </table>
//       </td>
//       </tr>
//       <tr>
//       <td style="background-color: #f4f4f4; padding: 0px 10px 0px 10px;" align="center">
//       <table border="0" width="480" cellspacing="0" cellpadding="0">
//       <tbody>
//       <tr>
//       <td style="background-color: #23293f; padding: 40px 30px 20px; font-family: Lato, Helvetica, Arial, sans-serif; font-size: 18px; font-weight: 400; line-height: 25px;" align="left">
//       <h2 style="font-size: 24px; font-weight: 400; margin: 0px;"><span style="color: #ffffff;">Unable to click on the button above?</span></h2>
//       </td>
//       </tr>
//       <tr>
//       <td style="background-color: #23293f; padding: 0px 30px 20px 30px; color: #666666; font-family: Lato, Helvetica, Arial, sans-serif; font-size: 18px; font-weight: 400; line-height: 25px;" align="left">
//       <p style="margin: 0;">Click on the link below or copy/paste in the address bar.</p>
//       </td>
//       </tr>
//       <tr>
//       <td style="background-color: #23293f; padding: 0px 30px 40px; font-family: Lato, Helvetica, Arial, sans-serif; font-size: 18px; font-weight: 400; line-height: 25px;" align="left">
//       <p style="margin: 0px;"><a href="!verifyLink"><span style="text-decoration: underline; color: #ffffff;">!verifyLink</span></a></p>
//       </td>
//       </tr>
//       </tbody>
//       </table>
//       </td>
//       </tr>
//       <tr>
//       <td style="background-color: #f4f4f4; padding: 30px 10px 0px 10px;" align="center">
//       <table border="0" width="480" cellspacing="0" cellpadding="0">
//       <tbody>
//       <tr>
//       <td style="background-color: #c6c2ed; padding: 30px 30px 30px 30px; color: #666666; font-family: Lato, Helvetica, Arial, sans-serif; font-size: 18px; font-weight: 400; line-height: 25px;" align="center">
//       <h2 style="font-size: 20px; font-weight: 400; color: #111111; margin: 0;">Need more help?</h2>
//       <p style="margin: 0;"><a style="color: #7c72dc;" href="!siteurl">We&rsquo;re here, ready to talk</a></p>
//       </td>
//       </tr>
//       </tbody>
//       </table>
//       </td>
//       </tr>
//       <tr>
//       <td style="background-color: #f4f4f4; padding: 0px 10px 0px 10px;" align="center">
//       <table border="0" width="480" cellspacing="0" cellpadding="0">
//       <tbody>
//       <tr>
//       <td style="background-color: #f4f4f4; padding: 0px 30px 30px 30px; color: #666666; font-family: Lato, Helvetica, Arial, sans-serif; font-size: 14px; font-weight: 400; line-height: 18px;" align="left">
//       <p style="margin: 0;">You received this email because you requested a password reset. If you did not, <a style="color: #111111; font-weight: bold;" href="!siteurl">Just Ignote It</a><a style="color: #111111; font-weight: bold;" href="!siteurl">.</a>.</p>
//       </td>
//       </tr>
//       <tr>
//       <td style="background-color: #f4f4f4; padding-top: 0px; padding-right: 30px; padding-bottom: 30px; color: #666666; font-family: Lato, Helvetica, Arial, sans-serif; font-size: 14px; font-weight: 400; line-height: 18px;" align="left">&nbsp;</td>
//       </tr>
//       </tbody>
//       </table>
//       </td>
//       </tr>
//       </tbody>
//       </table>';

//         DB::table('email_templates')->insert([
//             'slug' => 'verify-email',
//             'name' => 'Verify Email',
//             'value' => $value
//         ]);
//         DB::table('email_templates')->insert([
//             'name' => "Order Placed",
//             'slug' => "order-placed",
//             'value' => '<table border="0" cellpadding="0" cellspacing="0" width="100%">

//       <tbody><tr>
//           <td align="center" style="background-color:#23293f;">
//               <table border="0" cellpadding="0" cellspacing="0" width="480">
//                   <tbody><tr>
//                       <td align="center" valign="top" style="padding:40px 10px 40px 10px;">

//                       </td>
//                   </tr>
//               </tbody></table>
//           </td>
//       </tr>

//       <tr>
//           <td style="background-color:#23293f;padding:0px 10px 0px 10px;" align="center">
//               <table border="0" cellpadding="0" cellspacing="0" width="480">
//                   <tbody><tr>
//                       <td align="center" valign="top" style="background-color:#ffffff;padding:40px 20px 20px 20px;color:#111111;font-family:Lato, Helvetica, Arial, sans-serif;font-size:48px;font-weight:400;letter-spacing:4px;line-height:48px;">
//                         <h1 style="font-size:25px;font-weight:400;margin-left:10px;text-align:left;letter-spacing:0px;color:#111111;">Hi !clientName,</h1>
//                       </td>
//                   </tr>
//               </tbody></table>
//           </td>
//       </tr>

//       <tr>
//           <td align="center" style="background-color:#f4f4f4;padding:0px 10px 0px 10px;">
//               <table border="0" cellpadding="0" cellspacing="0" width="480">

//                 <tbody><tr>
//                   <td align="left" style="background-color:#ffffff;padding:20px 30px 40px 30px;color:#666666;font-family:Lato, Helvetica, Arial, sans-serif;font-size:18px;font-weight:400;line-height:25px;"><p style="margin:0;">Congrats Your order have been place successfully </p>
//                   </td>
//                 </tr>

//                 <tr>
//                   <td align="left" style="background-color:#ffffff;">

//                   </td>
//                 </tr>
//               </tbody></table>
//           </td>
//       </tr>

//       <tr>
//           <td align="center" style="background-color:#f4f4f4;padding:0px 10px 0px 10px;"><br>
//           </td>
//       </tr>

//       <tr>
//           <td align="center" style="background-color:#f4f4f4;padding:30px 10px 0px 10px;">
//               <table border="0" cellpadding="0" cellspacing="0" width="480">

//                   <tbody><tr>
//                     <td align="center" style="background-color:#C6C2ED;padding:30px 30px 30px 30px;color:#666666;font-family:Lato, Helvetica, Arial, sans-serif;font-size:18px;font-weight:400;line-height:25px;">
//                       <h2 style="font-size:20px;font-weight:400;color:#111111;margin:0;">Need more help?</h2>
//                       <p style="margin:0;"><a href="!siteurl" style="color:#7c72dc;">We’re here, ready to talk</a></p>
//                     </td>
//                   </tr>
//               </tbody></table>
//           </td>
//       </tr>

//       <tr>
//           <td align="center" style="background-color:#f4f4f4;padding:0px 10px 0px 10px;">
//               <table border="0" cellpadding="0" cellspacing="0" width="480">

//                 <tbody><tr>
//                   <td align="left" style="background-color:#f4f4f4;padding:0px 30px 30px 30px;color:#666666;font-family:Lato, Helvetica, Arial, sans-serif;font-size:14px;font-weight:400;line-height:18px;">
//                     <p style="margin:0;">You received this email because your payment information was changed. If you did not, <span style="color:#111111;"><b>please contact us.</b></span>.</p>
//                   </td>
//                 </tr>

//                 <tr>
//                   <td align="left" style="background-color:#f4f4f4;padding:0px 30px 30px 30px;color:#666666;font-family:Lato, Helvetica, Arial, sans-serif;font-size:14px;font-weight:400;line-height:18px;">
//                     <p style="margin:0;">!address</p>
//                   </td>
//                 </tr>
//               </tbody></table>
//           </td>
//       </tr>
        //   </tbody></table>'
//         ]);

//         DB::table('email_templates')->insert([
//             'name' => "invoice send",
//             'slug' => "send-invoice",
//             'value' => '<table border="0" cellpadding="0" cellspacing="0" width="100%"><tbody><tr><td align="center" style="background-color:#23293f;">
//     <table border="0" cellpadding="0" cellspacing="0" width="480"><tbody><tr><td align="center" valign="top" style="padding:40px 10px 40px 10px;">

//             </td>
//         </tr></tbody></table></td>
        // </tr><tr><td style="background-color:#23293f;padding:0px 10px 0px 10px;" align="center">
//     <table border="0" cellpadding="0" cellspacing="0" width="480"><tbody><tr><td align="center" valign="top" style="background-color:#ffffff;padding:40px 20px 20px 20px;color:#111111;font-family:Lato, Helvetica, Arial, sans-serif;font-size:48px;font-weight:400;letter-spacing:4px;line-height:48px;">
//               <h1 style="font-size:25px;font-weight:400;margin-left:10px;text-align:left;letter-spacing:0px;color:#111111;">Hi {user_name},</h1>
//             </td>
//         </tr></tbody></table></td>
        // </tr><tr><td align="center" style="background-color:#f4f4f4;padding:0px 10px 0px 10px;">
//     <table border="0" cellpadding="0" cellspacing="0" width="480"><tbody><tr><td align="left" style="background-color:#ffffff;padding:20px 30px 40px 30px;color:#666666;font-family:Lato, Helvetica, Arial, sans-serif;font-size:18px;font-weight:400;line-height:25px;">
//             <p style="margin: 0;">{sender_name} has sent you an invoice for Payment.</p>
//             <p style="margin: 0;">Your OTP for Payment is <b>{otp}</b> .</p>
//             <p style="margin:0;">Payment is easy. Just press the button below and follow the instructions. Well have you up and running in no time. </p>
//         </td>
//       </tr><tr><td align="left" style="background-color:#ffffff;">
//           <table width="100%" border="0" cellspacing="0" cellpadding="0"><tbody><tr><td align="center" style="background-color:#ffffff;padding:20px 30px 60px 30px;">
//                 <table border="0" cellspacing="0" cellpadding="0"><tbody><tr><td align="center"><a href="{payment_link}" style="font-size:20px;font-family:Helvetica, Arial, sans-serif;color:rgb(255,255,255);text-decoration:none;padding:15px 25px;border:1px solid rgb(124,114,220);background-color:rgb(0,0,0);">Pay Now</a></td>
//                   </tr></tbody></table></td>
//             </tr></tbody></table></td>
//       </tr></tbody></table></td>
        // </tr><tr><td align="center" style="background-color:#f4f4f4;padding:0px 10px 0px 10px;">
//     <table border="0" cellpadding="0" cellspacing="0" width="480"><tbody><tr><td align="left" style="background-color:rgb(35,41,63);padding:40px 30px 20px;font-family:Lato, Helvetica, Arial, sans-serif;font-size:18px;font-weight:400;line-height:25px;">
//             <h2 style="font-size:24px;font-weight:400;margin:0px;"><span style="color:rgb(255,255,255);">Unable to click on the button above?</span></h2>
//           </td>
//         </tr><tr><td align="left" style="background-color:#23293f;padding:0px 30px 20px 30px;color:#666666;font-family:Lato, Helvetica, Arial, sans-serif;font-size:18px;font-weight:400;line-height:25px;">
//             <p style="margin:0;">Click on the link below or copy/paste in the address bar.</p>
//           </td>
//         </tr><tr><td align="left" style="background-color:rgb(35,41,63);padding:0px 30px 40px;font-family:Lato, Helvetica, Arial, sans-serif;font-size:18px;font-weight:400;line-height:25px;">
//             <p style="margin:0px;"><a href="{payment_link}"><span style="text-decoration:underline;color:rgb(255,255,255);">{payment_link}</span></a></p>
//           </td>
//         </tr></tbody></table></td>
        // </tr><tr><td align="center" style="background-color:#f4f4f4;padding:30px 10px 0px 10px;">
//     <table border="0" cellpadding="0" cellspacing="0" width="480"><tbody><tr><td align="center" style="background-color:#C6C2ED;padding:30px 30px 30px 30px;color:#666666;font-family:Lato, Helvetica, Arial, sans-serif;font-size:18px;font-weight:400;line-height:25px;">
//             <h2 style="font-size:20px;font-weight:400;color:#111111;margin:0;">Need more help?</h2>
//             <p style="margin:0;"><a href="!siteurl" style="color:#7c72dc;">We’re here, ready to talk</a></p>
//           </td>
//         </tr></tbody></table></td>
        // </tr><tr><td align="center" style="background-color:#f4f4f4;padding:0px 10px 0px 10px;">
//     <table border="0" cellpadding="0" cellspacing="0" width="480"><tbody><tr><td align="left" style="background-color:#f4f4f4;padding:0px 30px 30px 30px;color:#666666;font-family:Lato, Helvetica, Arial, sans-serif;font-size:14px;font-weight:400;line-height:18px;">
//           <p style="margin:0;">You received this email because you requested a password reset. If you did not, <a href="!siteurl" style="color:#111111;font-weight:700;">please contact us.</a>.</p>
//         </td>
//       </tr><tr><td align="left" style="background-color:#f4f4f4;padding:0px 30px 30px 30px;color:#666666;font-family:Lato, Helvetica, Arial, sans-serif;font-size:14px;font-weight:400;line-height:18px;">
//           <p style="margin:0;">!address</p>
//         </td>
//       </tr></tbody></table></td>
        // </tr></tbody></table>'
//         ]);

//         DB::table('email_templates')->insert([
//             'name' => "invoice paid",
//             'slug' => "invoice-paid",
//             'value' => '<table border="0" cellpadding="0" cellspacing="0" width="100%"><tbody><tr><td align="center" style="background-color:#23293f;">
//     <table border="0" cellpadding="0" cellspacing="0" width="480"><tbody><tr><td align="center" valign="top" style="padding:40px 10px 40px 10px;">

//             </td>
//         </tr></tbody></table></td>
        // </tr><tr><td style="background-color:#23293f;padding:0px 10px 0px 10px;" align="center">
//     <table border="0" cellpadding="0" cellspacing="0" width="480"><tbody><tr><td align="center" valign="top" style="background-color:#ffffff;padding:40px 20px 20px 20px;color:#111111;font-family:Lato, Helvetica, Arial, sans-serif;font-size:48px;font-weight:400;letter-spacing:4px;line-height:48px;">
//               <h1 style="font-size:25px;font-weight:400;margin-left:10px;text-align:left;letter-spacing:0px;color:#111111;">Hi !clientName,</h1>
//             </td>
//         </tr></tbody></table></td>
        // </tr><tr><td align="center" style="background-color:#f4f4f4;padding:0px 10px 0px 10px;">
//     <table border="0" cellpadding="0" cellspacing="0" width="480"><tbody><tr><td align="left" style="background-color:#ffffff;padding:20px 30px 40px 30px;color:#666666;font-family:Lato, Helvetica, Arial, sans-serif;font-size:18px;font-weight:400;line-height:25px;">
//           <p style="margin:0;">Resetting your password is easy. Just press the button below and follow the instructions. Well have you up and running in no time. </p>
//         </td>
//       </tr><tr><td align="left" style="background-color:#ffffff;">
//           <table width="100%" border="0" cellspacing="0" cellpadding="0"><tbody><tr><td align="center" style="background-color:#ffffff;padding:20px 30px 60px 30px;">
//                 <table border="0" cellspacing="0" cellpadding="0"><tbody><tr><td align="center"><a href="!resetLink" style="font-size:20px;font-family:Helvetica, Arial, sans-serif;color:rgb(255,255,255);text-decoration:none;padding:15px 25px;border:1px solid rgb(124,114,220);background-color:rgb(0,0,0);">Reset Password</a></td>
//                   </tr></tbody></table></td>
//             </tr></tbody></table></td>
//       </tr></tbody></table></td>
        // </tr><tr><td align="center" style="background-color:#f4f4f4;padding:0px 10px 0px 10px;">
//     <table border="0" cellpadding="0" cellspacing="0" width="480"><tbody><tr><td align="left" style="background-color:rgb(35,41,63);padding:40px 30px 20px;font-family:Lato, Helvetica, Arial, sans-serif;font-size:18px;font-weight:400;line-height:25px;">
//             <h2 style="font-size:24px;font-weight:400;margin:0px;"><span style="color:rgb(255,255,255);">Unable to click on the button above?</span></h2>
//           </td>
//         </tr><tr><td align="left" style="background-color:#23293f;padding:0px 30px 20px 30px;color:#666666;font-family:Lato, Helvetica, Arial, sans-serif;font-size:18px;font-weight:400;line-height:25px;">
//             <p style="margin:0;">Click on the link below or copy/paste in the address bar.</p>
//           </td>
//         </tr><tr><td align="left" style="background-color:rgb(35,41,63);padding:0px 30px 40px;font-family:Lato, Helvetica, Arial, sans-serif;font-size:18px;font-weight:400;line-height:25px;">
//             <p style="margin:0px;"><a href="!resetLink"><span style="text-decoration:underline;color:rgb(255,255,255);">!resetLink</span></a></p>
//           </td>
//         </tr></tbody></table></td>
        // </tr><tr><td align="center" style="background-color:#f4f4f4;padding:30px 10px 0px 10px;">
//     <table border="0" cellpadding="0" cellspacing="0" width="480"><tbody><tr><td align="center" style="background-color:#C6C2ED;padding:30px 30px 30px 30px;color:#666666;font-family:Lato, Helvetica, Arial, sans-serif;font-size:18px;font-weight:400;line-height:25px;">
//             <h2 style="font-size:20px;font-weight:400;color:#111111;margin:0;">Need more help?</h2>
//             <p style="margin:0;"><a href="!siteurl" style="color:#7c72dc;">We’re here, ready to talk</a></p>
//           </td>
//         </tr></tbody></table></td>
        // </tr><tr><td align="center" style="background-color:#f4f4f4;padding:0px 10px 0px 10px;">
//     <table border="0" cellpadding="0" cellspacing="0" width="480"><tbody><tr><td align="left" style="background-color:#f4f4f4;padding:0px 30px 30px 30px;color:#666666;font-family:Lato, Helvetica, Arial, sans-serif;font-size:14px;font-weight:400;line-height:18px;">
//           <p style="margin:0;">You received this email because you requested a password reset. If you did not, <a href="!siteurl" style="color:#111111;font-weight:700;">please contact us.</a>.</p>
//         </td>
//       </tr><tr><td align="left" style="background-color:#f4f4f4;padding:0px 30px 30px 30px;color:#666666;font-family:Lato, Helvetica, Arial, sans-serif;font-size:14px;font-weight:400;line-height:18px;">
//           <p style="margin:0;">!address</p>
//         </td>
//       </tr></tbody></table></td>
        // </tr></tbody></table>'
//         ]);

//         DB::table('email_templates')->insert([
//             'name' => "Restock Notification Email",
//             'slug' => "restock-notification-email",
//             'value' => '
//             <table border="0" width="100%" cellspacing="0" cellpadding="0">
//             <tbody>
//             <tr>
//             <td style="background-color: #23293f;" align="center">
//             <table border="0" width="480" cellspacing="0" cellpadding="0">
//             <tbody>
//             <tr>
//             <td style="padding: 40px 10px 40px 10px;" align="center" valign="top">&nbsp;</td>
//             </tr>
//             </tbody>
//             </table>
//             </td>
//             </tr>
//             <tr>
//             <td style="background-color: #23293f; padding: 0px 10px 0px 10px;" align="center">
//             <table border="0" width="480" cellspacing="0" cellpadding="0">
//             <tbody>
//             <tr>
//             <td style="background-color: #ffffff; padding: 40px 20px 20px 20px; color: #111111; font-family: Lato, Helvetica, Arial, sans-serif; font-size: 48px; font-weight: 400; letter-spacing: 4px; line-height: 48px;" align="center" valign="top">
//             <h1 style="font-size: 25px; font-weight: 400; margin-left: 10px; text-align: left; letter-spacing: 0px; color: #111111;">Hi, --userName--</h1>
//             </td>
//             </tr>
//             </tbody>
//             </table>
//             </td>
//             </tr>
//             <tr>
//             <td style="background-color: #f4f4f4; padding: 0px 10px 0px 10px;" align="center">
//             <table border="0" width="480" cellspacing="0" cellpadding="0">
//             <tbody>
//             <tr>
//             <td style="background-color: #ffffff; padding: 20px 30px 40px 30px; color: #666666; font-family: Lato, Helvetica, Arial, sans-serif; font-size: 18px; font-weight: 400; line-height: 25px;" align="left">
//             <p style="margin: 0;">Your Product (--productName--) Quantity is less than the specified quantity (--quantity--).</p>
//             <p style="margin: 0;">Please Reorder It.</p>
//             <p style="margin: 0;"><a style="color: #7c72dc;" href="!restock_link">--Restock/Reorder-- URL</a></p>
//             </td>
//             </tr>
//             <tr>
//             <td style="background-color: #ffffff;" align="left">&nbsp;</td>
//             </tr>
//             </tbody>
//             </table>
//             </td>
//             </tr>
//             <tr>
//             <td style="background-color: #f4f4f4; padding: 0px 10px 0px 10px;" align="center">&nbsp;</td>
//             </tr>
//             <tr>
//             <td style="background-color: #f4f4f4; padding: 30px 10px 0px 10px;" align="center">
//             <table border="0" width="480" cellspacing="0" cellpadding="0">
//             <tbody>
//             <tr>
//             <td style="background-color: #c6c2ed; padding: 30px 30px 30px 30px; color: #666666; font-family: Lato, Helvetica, Arial, sans-serif; font-size: 18px; font-weight: 400; line-height: 25px;" align="center">
//             <h2 style="font-size: 20px; font-weight: 400; color: #111111; margin: 0;">Need more help?</h2>
//             <p style="margin: 0;"><a style="color: #7c72dc;" href="!siteurl">We&rsquo;re here, ready to talk</a></p>
//             </td>
//             </tr>
//             </tbody>
//             </table>
//             </td>
//             </tr>
//             <tr>
//             <td style="background-color: #f4f4f4; padding: 0px 10px 0px 10px;" align="center">
//             <table border="0" width="480" cellspacing="0" cellpadding="0">
//             <tbody>
//             <tr>
//             <td style="background-color: #f4f4f4; padding: 0px 30px 30px 30px; color: #666666; font-family: Lato, Helvetica, Arial, sans-serif; font-size: 14px; font-weight: 400; line-height: 18px;" align="left">
//             <p style="margin: 0;">you received this email because you have enabled restock inventory notifications</p>
//             </td>
//             </tr>
//             <tr>
//             <td style="background-color: #f4f4f4; padding-top: 0px; padding-right: 30px; padding-bottom: 30px; color: #666666; font-family: Lato, Helvetica, Arial, sans-serif; font-size: 14px; font-weight: 400; line-height: 18px;" align="left">&nbsp;</td>
//             </tr>
//             </tbody>
//             </table>
//             </td>
//             </tr>
//             </tbody>
//             </table>'
//         ]);

//         DB::table('email_templates')->insert([
//             'name' => "Cron Report Mail",
//             'slug' => "cron-report-mail",
//             'value' => '
//             <table border="0" width="100%" cellspacing="0" cellpadding="0">
//                 <tbody>
//                 <tr>
//                 <td style="background-color: #23293f;" align="center">
//                 <table border="0" width="480" cellspacing="0" cellpadding="0">
//                 <tbody>
//                 <tr>
//                 <td style="padding: 40px 10px 40px 10px;" align="center" valign="top">&nbsp;</td>
//                 </tr>
//                 </tbody>
//                 </table>
//                 </td>
//                 </tr>
//                 <tr>
//                 <td style="background-color: #23293f; padding: 0px 10px 0px 10px;" align="center">
//                 <table border="0" width="480" cellspacing="0" cellpadding="0">
//                 <tbody>
//                 <tr>
//                 <td style="background-color: #ffffff; padding: 40px 20px 20px 20px; color: #111111; font-family: Lato, Helvetica, Arial, sans-serif; font-size: 48px; font-weight: 400; letter-spacing: 4px; line-height: 48px;" align="center" valign="top">
//                 <h1 style="font-size: 25px; font-weight: 400; margin-left: 10px; text-align: left; letter-spacing: 0px; color: #111111;">Hi, --userName--</h1>
//                 </td>
//                 </tr>
//                 </tbody>
//                 </table>
//                 </td>
//                 </tr>
//                 <tr>
//                 <td style="background-color: #f4f4f4; padding: 0px 10px 0px 10px;" align="center">
//                 <table border="0" width="480" cellspacing="0" cellpadding="0">
//                 <tbody>
//                 <tr>
//                 <td style="background-color: #ffffff; padding: 20px 30px 40px 30px; color: #666666; font-family: Lato, Helvetica, Arial, sans-serif; font-size: 18px; font-weight: 400; line-height: 25px;" align="left">
//                 <p style="margin: 0;">Your Product (--productName--) Remaining Quantity is (--quantity--).<br />You are reveiving this email because you have enabled stock reorder notificatioins</p>
//                 </td>
//                 </tr>
//                 <tr>
//                 <td style="background-color: #ffffff;" align="left">&nbsp;</td>
//                 </tr>
//                 </tbody>
//                 </table>
//                 </td>
//                 </tr>
//                 <tr>
//                 <td style="background-color: #f4f4f4; padding: 0px 10px 0px 10px;" align="center">&nbsp;</td>
//                 </tr>
//                 <tr>
//                 <td style="background-color: #f4f4f4; padding: 30px 10px 0px 10px;" align="center">
//                 <table border="0" width="480" cellspacing="0" cellpadding="0">
//                 <tbody>
//                 <tr>
//                 <td style="background-color: #c6c2ed; padding: 30px 30px 30px 30px; color: #666666; font-family: Lato, Helvetica, Arial, sans-serif; font-size: 18px; font-weight: 400; line-height: 25px;" align="center">
//                 <h2 style="font-size: 20px; font-weight: 400; color: #111111; margin: 0;">Need more help?</h2>
//                 <p style="margin: 0;"><a style="color: #7c72dc;" href="!siteurl">We&rsquo;re here, ready to talk</a></p>
//                 </td>
//                 </tr>
//                 </tbody>
//                 </table>
//                 </td>
//                 </tr>
//                 <tr>
//                 <td style="background-color: #f4f4f4; padding: 0px 10px 0px 10px;" align="center">
//                 <table border="0" width="480" cellspacing="0" cellpadding="0">
//                 <tbody>
//                 <tr>
//                 <td style="background-color: #f4f4f4; padding: 0px 30px 30px 30px; color: #666666; font-family: Lato, Helvetica, Arial, sans-serif; font-size: 14px; font-weight: 400; line-height: 18px;" align="left">
//                 <p style="margin: 0;">you received this email because you have enabled restock inventory notifications</p>
//                 </td>
//                 </tr>
//                 <tr>
//                 <td style="background-color: #f4f4f4; padding-top: 0px; padding-right: 30px; padding-bottom: 30px; color: #666666; font-family: Lato, Helvetica, Arial, sans-serif; font-size: 14px; font-weight: 400; line-height: 18px;" align="left">&nbsp;</td>
//                 </tr>
//                 </tbody>
//                 </table>
//                 </td>
//                 </tr>
//                 </tbody>
//                 </table>'
//         ]);
    }
}
