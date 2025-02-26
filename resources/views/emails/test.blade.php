@component('mail::message')
# Test Email Configuration

This is a test email from {{ config('app.name') }}. If you're receiving this, your email configuration is working correctly.

## SMTP Settings
- Host: {{ config('mail.mailers.smtp.host') }}
- Port: {{ config('mail.mailers.smtp.port') }}
- Encryption: {{ config('mail.mailers.smtp.encryption') }}

@component('mail::button', ['url' => route('admin.settings')])
Return to Settings
@endcomponent

Thanks,<br>
{{ config('app.name') }}
@endcomponent
