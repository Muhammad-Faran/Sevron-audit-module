<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use OwenIt\Auditing\Contracts\Auditable;

class FileUpload extends Model implements Auditable
{
    use \OwenIt\Auditing\Auditable;

    protected $fillable = ['user_id', 'file_path', 'description'];

    protected $auditExclude = [
        'file_path',
    ];


     /**
     * Transform the data to be audited.
     *
     * @param  array  $data
     * @return array
     */
    public function transformAudit(array $data): array
    {
        // Mask the 'description' field if it contains sensitive information
        if (isset($data['new_values']['description'])) {
            $data['new_values']['description'] = $this->maskDescription($data['new_values']['description']);
        }

        return $data;
    }

    private function maskDescription($description)
    {
        // Custom logic to mask sensitive information in the description
        return str_repeat('*', strlen($description));
    }
}
