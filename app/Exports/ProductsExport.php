namespace App\Exports;

use App\Models\Product;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;

class ProductsExport implements FromCollection, WithHeadings
{
    public function collection()
    {
        return Product::with('category')->get()->map(function ($product) {
            return [
                $product->id,
                $product->name,
                $product->price,
                $product->category->name ?? 'Không có',
                $product->description,
            ];
        });
    }

    public function headings(): array
    {
        return ['ID', 'Tên', 'Giá', 'Danh mục', 'Mô tả'];
    }
}
