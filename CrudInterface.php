<?php
declare(strict_types = 1);
interface CRUD {
    /**
     * @param string $start
     * @param string $end
     * @return array
     */
    public function getBetweenDates(string $start, string $end);

    /**
     * @param array $attributes
     * @return array
     */
    public function create(array $attributes);

    /**
     * @param string $id
     * @param array $attributes
     * @return mixed
     */
    public function update(string $id, array $attributes);
}