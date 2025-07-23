<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Str;

class FetchJsonPlaceholder extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'app:fetch-json-placeholder';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $endpoints = ['users', 'posts', 'comments', 'albums', 'photos', 'todos'];

        foreach ($endpoints as $endpoint) {
            $response = Http::get("https://jsonplaceholder.typicode.com/{$endpoint}");

            if ($response->failed()) {
                $this->error("Failed to fetch {$endpoint}");
                continue;
            }

            $data = $response->json();
            $modelClass = "\\App\\Models\\" . ucfirst(Str::singular($endpoint));

            foreach ($data as $item) {
                $snakeItem = $this->toSnakeKeys($item);

                if ($endpoint === 'users') {
                    $snakeItem['password'] = Hash::make('password');
                }

                $modelClass::updateOrCreate(['id' => $item['id']], $snakeItem);
            }

            $this->info("Fetched and saved {$endpoint}");
        }
    }

    protected function toSnakeKeys(array $data): array
    {
        return collect($data)->mapWithKeys(function ($value, $key) {
            if (is_array($value)) {
                return [Str::snake($key) => json_encode($value)];
            }

            if ($key === "email") {
                $value = strtolower($value);
            }

            return [Str::snake($key) => $value];
        })->toArray();
    }
}
