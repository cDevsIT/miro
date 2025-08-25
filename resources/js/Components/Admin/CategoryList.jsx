<table className="min-w-full divide-y divide-gray-200">
    <thead>
        <tr>
            <th>Name</th>
            <th>Type</th>
            <th>Order</th>
            <th>Actions</th>
        </tr>
    </thead>
    <tbody>
        {categories.map(category => (
            <tr key={category.id}>
                <td>{category.name}</td>
                <td>{category.type === 'indoor' ? 'Indoor Product' : 'Outdoor Product'}</td>
                <td>{category.order}</td>
                <td>
                    {/* ... action buttons ... */}
                </td>
            </tr>
        ))}
    </tbody>
</table> 