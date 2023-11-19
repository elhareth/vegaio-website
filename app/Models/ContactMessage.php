<?php

namespace App\Models;

use InvalidArgumentException;

use Elhareth\LaravelEloquentMetable\IsMetable;
use Elhareth\LaravelEloquentMetable\IsMetableInterface;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Concerns\HasUlids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ContactMessage extends Model implements IsMetableInterface
{
    use HasUlids;
    use HasFactory;
    use IsMetable;

    /**
     * Table name
     */
    protected $table = 'contact_messages';

    /**
     * Default timestamps
     */
    public $timestamps = false;

    /**
     *
     */
    protected $guarded = [
        'ulid',
        'added',
    ];

    /**
     *
     */
    protected $casts = [
        'read' => 'boolean',
        'added' => 'datetime',
    ];

    /**
     *
     *
     */
    protected $with =[
        'metalist',
    ];

    /**
     * Default Metables
     *
     * @return array
     */
    protected function defaultMetables(): array
    {
        return [
            'preset' => [
                'value' => now()->format('Y-m-d'),
                'group' => null,
            ],
            'attachments' => [
                'value' => [],
                'group' => null,
            ],
        ];
    }

    /**
     *
     *
     */
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    /**
     * Set model read state
     *
     * @param  bool $read
     * @return void
     */
    public function setRead(bool $read = true)
    {
        $this->read = $read;
        $this->push();
    }

    /**
     * Set as unread
     *
     * @return void
     */
    public function setUnread()
    {
        return $this->setRead(false);
    }
}
