<?php
// This file is part of Moodle - http://moodle.org/
//
// Moodle is free software: you can redistribute it and/or modify
// it under the terms of the GNU General Public License as published by
// the Free Software Foundation, either version 3 of the License, or
// (at your option) any later version.
//
// Moodle is distributed in the hope that it will be useful,
// but WITHOUT ANY WARRANTY; without even the implied warranty of
// MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
// GNU General Public License for more details.
//
// You should have received a copy of the GNU General Public License
// along with Moodle.  If not, see <http://www.gnu.org/licenses/>.

/**
 * Hebrew language strings.
 *
 * @package    local_zoomsyncusers
 * @author     Yedidia Klein <yedidia@openapp.co.il>
 * @copyright  Yedidia Klein
 * @license    http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */

defined('MOODLE_INTERNAL') || die();

$string['pluginname'] = 'סנכרון משתמשי Zoom';
$string['zoomsyncusers'] = 'סנכרון משתמשי Zoom';
$string['domain'] = 'דומיין דוא"ל לסנכרון';
$string['domaindesc'] = 'רק משתמשים עם כתובת דוא"ל מהדומיין הזה במודל ייווצרו ב-Zoom.';
$string['syncusers'] = 'סנכרון משתמשי Zoom';
$string['createtype'] = 'סוג יצירה';
$string['createtypedesc'] = 'בחר את סוג יצירת המשתמש.
יצירה אוטומטית תיצור משתמשים אוטומטית ללא לבקש מהמשתמש לאשר,
זה יעבוד אם Zoom מאפשר זאת בחשבון שלך (כנראה חשבון ארגוני).
יצירה תיצור משתמשים ותשלח להם דוא"ל אישור.
ראה <a href="https://developers.zoom.us/docs/api/users/#tag/users/POST/users">
תיעוד Zoom</a> לפרטים נוספים.';
$string['autoCreate'] = 'יצירה אוטומטית';
$string['create'] = 'יצירה';
$string['custCreate'] = 'יצירה מותאמת';
$string['ssoCreate'] = 'יצירת SSO';
$string['syncroles'] = 'סנכרון משתמשים עם תפקידים נבחרים (נקה שדה דומיין עבור אפשרות זו)';
$string['syncrolesdesc'] = 'כאשר תפקידים נבחרים, סנכרן רק משתמשים שיש להם אחד מהתפקידים הנבחרים לפחות בהקשר קורס אחד (עליך לנקות שדה דומיין כדי להשתמש באפשרות זו).';
$string['dryrun'] = 'ניתוח הרצה יבשה';
$string['dryrunshort'] = 'הרצה יבשה';
$string['dryrunlink'] = 'צפה במה יסונכרן';
$string['currentconfig'] = 'הגדרות נוכחיות:';
$string['domainlabel'] = 'דומיין:';
$string['createtypelabel'] = 'סוג יצירה:';
$string['selectedroleslabel'] = 'תפקידים נבחרים:';
$string['notset'] = 'לא מוגדר';
$string['noneselected'] = 'לא נבחר';
$string['taskaction'] = 'פעולת המשימה:';
$string['syncroleswith'] = 'סנכרון משתמשים עם תפקידים נבחרים: {$a}';
$string['errornorolesselected'] = 'שגיאה: לא נבחרו תפקידים. המשימה לא תרוץ.';
$string['errornodomainorroles'] = 'שגיאה: לא צוין דומיין ולא נבחרו תפקידים. המשימה לא תרוץ.';
$string['syncdomainusers'] = 'סנכרון כל המשתמשים עם דומיין דוא"ל: {$a}';
$string['userstoprocess'] = 'משתמשים שיעובדו (סה"כ {$a}):';
$string['zoomapiavailable'] = '✓ חיבור ל-API של Zoom זמין';
$string['zoomapifailed'] = '✗ חיבור ל-API של Zoom נכשל: {$a}';
$string['tablename'] = 'שם';
$string['tableemail'] = 'דוא"ל';
$string['tablezoomstatus'] = 'סטטוס ב-Zoom';
$string['tableaction'] = 'פעולה שתתבצע';
$string['statusunknown'] = 'לא ידוע';
$string['statusexists'] = '✓ קיים';
$string['statusdoesnotexist'] = '✗ לא קיים';
$string['actionskip'] = 'דלג (כבר קיים)';
$string['actioncreate'] = 'יצירת משתמש (סוג: {$a})';
$string['actionwouldcreate'] = 'ינסה ליצור';
$string['actionwouldcreatetype'] = 'ינסה ליצור (סוג: {$a})';
$string['errorchecking'] = 'שגיאה בבדיקה: {$a}';
$string['summary'] = 'סיכום:';
$string['userstocreate'] = 'משתמשים ליצירה: {$a}';
$string['userstoskip'] = 'משתמשים לדילוג: {$a}';
$string['totalusers'] = 'סה"כ משתמשים: {$a}';
$string['result'] = 'תוצאה:';
$string['nousers'] = 'לא נמצאו משתמשים שמתאימים לקריטריונים. המשימה לא תעבד משתמשים.';
$string['backtosettings'] = 'חזרה להגדרות סנכרון משתמשי Zoom';
