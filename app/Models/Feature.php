<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Feature extends Model
{
    use HasFactory;
    protected $table = "features";
    protected $fillable = [
        "tenant_id",
        "title",
        "slug",
        "order",
        "icon_class",
        "feature_image",
        "description",
        "facebook_link",
        "youtube_link",
        "instagram_link",
        "twitter_link",
        "images",
        "files",
        "is_active"
    ];
}
