<?php

namespace App\Services;

use App\Exceptions\InputException;
use App\Repositories\OmenaRepository;
use Illuminate\Support\Facades\Log;

class StickerService extends OmenaService
{
    protected $OmenaRepository;

    /**
     * OmenaService constructor.
     * @param OmenaRepository $OmenaRepository
     */
    public function __construct(OmenaRepository $OmenaRepository)
    {
        $this->OmenaRepository = $OmenaRepository;
    }

    /**
     * @return \App\Models\Sticker[]|\Illuminate\Database\Eloquent\Collection
     */
    public function getStickerList() {
        return $this->OmenaRepository->getStickerList();
    }

    /**
     * @param $type
     * @param $name
     * @return mixed
     * @throws InputException
     */
    public function updateSticker($type, $name) {
        switch ($type){
            case -1:
                $result = $this->_minusSticker($name);
                break;
            case 1:
                $result = $this->_addSticker($name);
                break;
            default:
                throw new InputException('Type values is empty or invalid.');
        }
        return ['Success' => true, 'Message' => $result];
    }

    /**
     * @param $name
     * @throws \App\Exceptions\SqlException
     */
    private function _addSticker($name) {
        return $this->OmenaRepository->addSticker($name);
    }

    /**
     * @param $name
     * @throws \App\Exceptions\SqlException
     */
    private function _minusSticker($name) {
        return $this->OmenaRepository->minusSticker($name);
    }
}
