<?php

namespace App\Http\Livewire\Product;

use App\Models\Business;
use App\Models\Category;
use App\Models\Product;
use Livewire\Component;
use Spatie\MediaLibrary\MediaCollections\Models\Media;

class Edit extends Component
{
    public Product $product;

    public array $mediaToRemove = [];

    public array $listsForFields = [];

    public array $mediaCollections = [];

    public function addMedia($media): void
    {
        $this->mediaCollections[$media['collection_name']][] = $media;
    }

    public function removeMedia($media): void
    {
        $collection = collect($this->mediaCollections[$media['collection_name']]);

        $this->mediaCollections[$media['collection_name']] = $collection->reject(fn ($item) => $item['uuid'] === $media['uuid'])->toArray();

        $this->mediaToRemove[] = $media['uuid'];
    }

    public function getMediaCollection($name)
    {
        return $this->mediaCollections[$name];
    }

    protected function syncMedia(): void
    {
        collect($this->mediaCollections)->flatten(1)
            ->each(fn ($item) => Media::where('uuid', $item['uuid'])
                ->update(['model_id' => $this->product->id]));

        Media::whereIn('uuid', $this->mediaToRemove)->delete();
    }

    public function mount(Product $product)
    {
        $this->product = $product;
        $this->initListsForFields();
        $this->mediaCollections = [

            'product_picture' => $product->picture,

        ];
    }

    public function render()
    {
        return view('livewire.product.edit');
    }

    public function submit()
    {
        $this->validate();

        $this->product->save();
        $this->syncMedia();

        return redirect()->route('admin.products.index');
    }

    protected function rules(): array
    {
        return [
            'product.name' => [
                'string',
                'required',
            ],
            'product.description' => [
                'string',
                'nullable',
            ],
            'mediaCollections.product_picture' => [
                'array',
                'required',
            ],
            'mediaCollections.product_picture.*.id' => [
                'integer',
                'exists:media,id',
            ],
            'product.unit_price' => [
                'numeric',
                'required',
            ],
            'product.business_id' => [
                'integer',
                'exists:businesses,id',
                'required',
            ],
            'product.category_id' => [
                'integer',
                'exists:categories,id',
                'required',
            ],
        ];
    }

    protected function initListsForFields(): void
    {
        $this->listsForFields['business'] = Business::pluck('name', 'id')->toArray();
        $this->listsForFields['category'] = Category::pluck('name', 'id')->toArray();
    }
}
