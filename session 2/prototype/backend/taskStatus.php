<?php

class TaskStatus
{
    public function __construct(
        public int $id,
        public string $name,
        public string $description
    ) {}
}
