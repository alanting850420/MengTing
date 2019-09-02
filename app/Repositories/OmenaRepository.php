<?php
/**
 * Created by PhpStorm.
 * User: alan.ting
 * Date: 2019-08-27
 * Time: 14:01
 */

namespace App\Repositories;

use App\Exceptions\SqlException;
use App\Models\Sticker;
use Illuminate\Support\Facades\Log;

class OmenaRepository
{
    /**
     * @return Sticker[]|\Illuminate\Database\Eloquent\Collection
     */
    public function getStickerList() {
        return Sticker::all();
    }

    /**
     * @param String $name
     * @return mixed
     */
    public function getStickers(String $name) {
        return Sticker::where('name',$name)->firstOrFail()->counts;
    }

    /**
     * @param String $name
     * @throws SqlException
     */
    public function addSticker(String $name) {
        try{
            $sticker = Sticker::where('name',$name)->firstOrFail();
            $sticker->counts += 1;
            $sticker->save();
            return $sticker;
        } catch (\Exception $exception) {
            throw new SqlException($exception->getMessage());
        }
    }

    /**
     * @param String $name
     * @throws SqlException
     */
    public function minusSticker(String $name) {
        try{
            $sticker = Sticker::where('name',$name)->firstOrFail();
            $sticker->counts -= 1;
            $sticker->save();
            return $sticker;
        } catch (\Exception $exception) {
            throw new SqlException($exception->getMessage());
        }
    }
}
