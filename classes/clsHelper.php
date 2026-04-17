<?php

class clsHelper
{
    // 🔹 دالة لتنظيف النص (تستخدم غالبًا عند العرض)
    public static function clean($value)
    {
        // trim: إزالة الفراغات من البداية والنهاية
        // htmlspecialchars: تحويل الرموز الخاصة لحماية من XSS
        return htmlspecialchars(trim($value));
    }

    // 🔹 جلب قيمة من POST وتنظيفها مباشرة
    public static function post($key)
    {
        // إذا القيمة موجودة في POST
        if (isset($_POST[$key])) {
            // ننظفها ونرجعها
            return self::clean($_POST[$key]);
        }

        // إذا غير موجودة نرجع null
        return null;
    }

    // 🔹 التحقق من الإيميل
    public static function email($value)
    {
        // تنظيف الإيميل من أي رموز غير صحيحة
        $value = filter_var(trim($value), FILTER_SANITIZE_EMAIL);

        // التحقق إذا الإيميل صحيح
        if (filter_var($value, FILTER_VALIDATE_EMAIL)) {
            return $value; // إيميل صحيح
        }

        return false; // إيميل غير صالح
    }

    // 🔹 تنظيف نص بدون تحويل HTML (مناسب للتخزين في DB)
    public static function raw($value)
    {
        // فقط إزالة الفراغات بدون تغيير النص
        return trim($value);
    }

    // 🔹 التحقق من الحد الأدنى للطول
    public static function minLength($value, $length)
    {
        // strlen: تحسب عدد الأحرف
        return strlen($value) >= $length;
    }

    // 🔹 التحقق من تطابق قيمتين (مثل كلمة المرور)
    public static function match($value1, $value2)
    {
        // === تعني تطابق كامل (قيمة + نوع)
        return $value1 === $value2;
    }

    // 🔹 التحقق أن القيمة رقم صحيح
    public static function number($value)
    {
        // يرجع الرقم إذا صحيح، أو false إذا لا
        return filter_var($value, FILTER_VALIDATE_INT);
    }

    // 🔹 جلب قيمة من POST بدون تنظيف HTML (للاستخدام الداخلي)
    public static function input($key)
    {
        // إذا موجودة نرجعها بعد trim فقط
        // بدون htmlspecialchars (مهم للـ DB)
        return isset($_POST[$key]) ? trim($_POST[$key]) : null;
    }
}
