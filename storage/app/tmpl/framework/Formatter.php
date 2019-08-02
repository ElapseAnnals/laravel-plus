<?php

namespace App\Formatters;

/**
 * Class TempFormatter
 *
 * @package App\Formatters
 */
class TempFormatter extends Formatter
{
    /**
     * @param array $data
     *
     * @return array
     */
    public function formatIndex(array $data): array
    {
        $items = collect($data['temps']->items())->toArray();
        foreach ($items as &$item) {
            $item['info'] = [$item['info']];
        }
        return [
            'info' => $data['info'],
            'js_data' => [
                'data' => $items,
                'page' => $this->assemblyPage($data['temps']),
            ],
            'list_map' => $data['list_map'],
            'search_map' => $data['search_map'],
        ];
    }

    /**
     * @param array $data
     *
     * @return array
     */
    public function formatShow(array $data): array
    {
        return $data;
    }
}
