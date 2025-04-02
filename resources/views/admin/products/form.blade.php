<label>Tên sản phẩm:</label><br>
<input type="text" name="name" value="{{ old('name', $product->name ?? '') }}" required><br><br>

<label>Giá:</label><br>
<input type="number" name="price" value="{{ old('price', $product->price ?? '') }}" required><br><br>

<label>Mô tả:</label><br>
<textarea name="description">{{ old('description', $product->description ?? '') }}</textarea><br><br>

<button type="submit">💾 Lưu</button>
