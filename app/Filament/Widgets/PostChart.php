<?php


namespace App\Filament\Widgets;


use Filament\Widgets\ChartWidget;
use App\Models\Post;
use Carbon\Carbon;

class PostChart extends ChartWidget
{
    protected ?string $heading = 'Chart';
    protected static ?int $sort = 2;
    // protected string|int|array $columnSpan = 'full';

    private function getPostsCreatedByMonth()
    {
        $perMonth = [];

        $months = collect(range(1, 12))->map(function ($month) use (&$perMonth) {
            $count = Post::whereMonth('created_at', $month)
                ->whereYear('created_at', now()->year)
                ->count();

            $perMonth[] = $count;

            return now()->month($month)->format('M');
        });

        return [
            'labels' => $months,
            'data' => $perMonth
        ];
    }

    protected function getData(): array
    {
        $data = $this->getPostsCreatedByMonth();
        return [
            'datasets' => [
                [
                    'label' => 'Posts Criados por Mês ' . now()->year,
                    'data' => $data['data'],
                ],
            ],
            'labels' => $data['labels'],
        ];
    }

    protected function getType(): string
    {
        return 'line';
    }
}
