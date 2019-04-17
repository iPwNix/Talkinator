<?php

function getAvatarPath($avatar)
{
    return asset('uploads/users/avatars/' . $avatar);
}

function getProfileCoverPath($cover)
{
    return asset('uploads/users/covers/' . $cover);
}