<?php
namespace App\Models;
use App\Rules\IsValidCameroonianPhoneNumber;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
class Phone extends Model
{
    use HasFactory;
    protected $fillable = [
        'number',
        'contact_id'
    ];

    public function contact() {
        return $this->belongsTo(Contact::class);
    }

    protected $casts = [
        'number' => 'array',
        
        // ...
    ];

    public static function rules() {
        return [
            
            'number' => [
                'nullable',
                'array',
            ],
            'number.*' => [
                'nullable',
                new IsValidCameroonianPhoneNumber,
            ],
        ];
    }
}