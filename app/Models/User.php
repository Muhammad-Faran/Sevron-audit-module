<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use OwenIt\Auditing\Contracts\Auditable;

class User extends Authenticatable implements Auditable
{
    /** @use HasFactory<\Database\Factories\UserFactory> */
    use HasFactory, Notifiable, \OwenIt\Auditing\Auditable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'email',
        'password',
        'profile_photo',
        'sensitive_data',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    protected $auditInclude = [
        'name',
        'email',
        'profile_photo',
        'sensitive_data',
    ];

    protected $auditExclude = [
        'password',
        'remember_token',
        // Add other attributes you don't want to audit
    ];

    public function requiresAudit(): bool
    {
        // Only audit if the 'sensitive_data' field was changed
        return $this->isDirty(['sensitive_data', 'name']);
    }

     /**
     * Transform the data to be audited.
     *
     * @param  array  $data
     * @return array
     */
    public function transformAudit(array $data): array
    {
        // Mask the 'email' field in the 'new_values' array
        if (isset($data['new_values']['email'])) {
            $data['new_values']['email'] = $this->maskEmail($data['new_values']['email']);
        }

        // Mask the 'email' field in the 'old_values' array
        if (isset($data['old_values']['email'])) {
            $data['old_values']['email'] = $this->maskEmail($data['old_values']['email']);
        }

        return $data;
    }

    /**
     * Helper method to mask email addresses.
     *
     * @param  string  $email
     * @return string
     */
    private function maskEmail($email)
    {
        $parts = explode('@', $email);
        $domain = array_pop($parts);
        $name = implode('@', $parts);
        $maskedName = substr($name, 0, 2) . str_repeat('*', max(strlen($name) - 2, 0));
        return $maskedName . '@' . $domain;
    }

    /**
     * Get the attributes that should be cast.
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
        ];
    }
}
