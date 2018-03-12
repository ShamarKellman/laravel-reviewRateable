<?php

namespace ShamarKellman\ReviewRateable\Models;

use Illuminate\Database\Eloquent\Model;

class Rating extends Model
{
    /**
     * @var string
     */
    protected $table = 'ratings';

    /**
     * @var array
     */
    protected $guarded = ['id', 'status', 'created_at', 'updated_at'];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\MorphTo
     */
    public function reviewrateable()
    {
        return $this->morphTo();
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\MorphTo
     */
    public function author()
    {
        return $this->morphTo('author');
    }

    /**
     * @param $query
     * @return mixed
     */
    public function scopeApproved($query)
    {
        return $query->where('status', true);
    }

    /**
     * @param Model $reviewrateable
     * @param $data
     * @param Model $author
     *
     * @return static
     */
    public function createRating(Model $reviewrateable, $data, Model $author)
    {
        $rating = new static();
        $rating->fill(array_merge($data, [
            'author_id' => $author->id,
            'author_type' => get_class($author),
        ]));

        $reviewrateable->ratings()->save($rating);

        return $rating;
    }

    /**
     * @param $id
     * @param $data
     *
     * @return mixed
     */
    public function updateRating($id, $data)
    {
        $rating = static::find($id);
        $rating->update($data);

        return $rating;
    }

    /**
     * @param $id
     *
     * @return mixed
     */
    public function deleteRating($id)
    {
        return static::find($id)->delete();
    }
    
    /**
     *
     * @return boolean
     */
    public function approveRating($id)
    {
        return $this->status = true;
    }

    /**
     *
     * @return boolean
     */
    public function isApproved()
    {
        return $this->status;
    }
}
