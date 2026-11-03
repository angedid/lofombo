<?php

namespace Tests\Feature;

use Tests\TestCase;

class EmailTemplatesTest extends TestCase
{
    public function test_all_email_templates_render_without_external_assets(): void
    {
        $data = [
            'enterprise' => 'Demo Boutique', 'gender' => 'Mme', 'name' => 'Test Client',
            'telephone' => '+237600000000', 'secret' => 'sample-secret',
            'subject' => 'Example subject', 'message' => '<script>example</script>',
            'msg' => ['Example message', 'Example details'], 'code' => '1411-6478-8398',
            'config' => (object) ['enterprise_name' => 'Demo Boutique'],
            'clientLoginUrl' => 'https://example.com/login',
            'login_url' => 'https://example.com/login', 'pseudo' => 'example',
            'passwordRecoveringUrl' => 'https://example.com/reset?token=example',
            'invitation_url' => 'https://example.com/invitation', 'inviter' => 'Test Inviter',
        ];
        $files = glob(resource_path('views/mailtemplates/emailtemplates/*.blade.php'));
        $this->assertCount(12, $files);
        foreach ($files as $file) {
            $name = basename($file, '.blade.php');
            $html = view('mailtemplates.emailtemplates.'.$name, compact('data'))->render();
            $this->assertStringContainsString('bgcolor="#5b4897"', $html, $name);
            $this->assertStringContainsString('max-width:600px', $html, $name);
            $this->assertStringNotContainsString('<script', $html, $name);
            $this->assertStringNotContainsString('<link', $html, $name);
            $this->assertSame(preg_match_all('/<div\b/', $html), substr_count($html, '</div>'), $name);
            if ($name === 'password-forgot') {
                $this->assertStringContainsString($data['passwordRecoveringUrl'], $html);
            }
            if ($name === 'send-voucher-usage-code') {
                $this->assertStringContainsString($data['code'], $html);
            }
        }
    }
}
