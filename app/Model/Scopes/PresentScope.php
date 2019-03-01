<?php

namespace App\Model\Scopes;

use App\Model\Scopes\Base\Base;

trait PresentScope
{
    use Base;

    public function scopeWithPrimaryKey($query, $hotelCode, $hotelPlanCode, $roomclassCode, $roomPaxcount, $itemCode, $useDate)
    {
        return $query->where('hotel_code', $hotelCode)
            ->where('hotelplan_code', $hotelPlanCode)
            ->where('roomclass_code', $roomclassCode)
            ->where('room_paxcount', $roomPaxcount)
            ->where('item_code', $itemCode)
            ->where('use_date', $useDate);
    }

    public function hasPresent($query)
    {
        return $query->where('quantity', '>', 0)->where('remain_quantity', '>', 0);
    }

    public function scopePresentOnePt($query)
    {
        return $this->hasPresent($query)->where('type', getConstant('TYPE_PRESENT_1_PT'));
    }

    public function scopePresentFivePt($query)
    {
        return $this->hasPresent($query)->where('type', getConstant('TYPE_PRESENT_5_PT'));
    }
}
