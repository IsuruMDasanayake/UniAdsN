<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Manage Categories</title>
    <link rel="icon" type="image/x-icon" href="{{ asset('favicon.ico') }}">
    <link rel="stylesheet" href="{{ asset('admin/css/style.css') }}">
    <link rel="stylesheet" href="{{ asset('admin/css/categories.css') }}">
    <link rel="stylesheet" href="{{ asset('admin/css/admindash.css') }}">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
    <style>
        
    </style>
</head>
<body>
    <div class="page-flex">
        @include('admin.sidebar')
        <div class="main-wrapper">
            @include('admin.mainnavbar')
            <div class="container">
                <div class="user-table-header">
                    <h1 class="title">Manage Categories</h1>
                    <button class="btn btn-add" onclick="openAddCategoryForm()">Add New Category</button>
                </div>
                
                <table class="table">
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>Main Category</th>
                            <th>Name</th>
                            <th>Icon</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($categories as $category)
                        <tr>
                            <td>{{ $category->id }}</td>
                            <td>{{ $category->main_category }}</td>
                            <td>{{ $category->name }}</td>
                            <td>
                                <i class="{{ $category->icon }}"></i> <!-- Render the icon -->
                            </td>
                            <td>
                                <button class="btn btn-primary" onclick="openEditCategoryForm()">Edit</button>
                                <form action="{{ route('categories.destroy', $category->id) }}" method="POST" style="display:inline;">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-danger">Delete</button>
                                </form>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>

                <!-- Add Category Form Modal -->
        <div id="addCategoryForm" class="modal">
            <div class="modal-content">
                <span class="close-btn" onclick="closeAddCategoryForm()">×</span>
                <h3 class="modal-title">Add New Category</h3>
                <form action="{{ route('categories.store') }}" method="POST">
                    @csrf
                    <div class="form-group">
                        <label for="main_category">Main Category</label>
                        <select name="main_category" id="main_category" required>
                            <option value="">Select Main Category</option>
                            <option value="Courses">Courses</option>
                            <option value="Course Type">Course Type</option>
                            <option value="Location">Location</option>
                            <option value="Duration">Duration</option>
                            <option value="Course Format">Course Format</option>
                            <option value="Attendance Type">Attendance Type</option>
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="name">Name</label>
                        <input type="text" name="name" id="name" required>
                    </div>

                    <!-- Icon Selection -->
                    <div class="form-group">
                        <label for="icon">Select Icon:</label>
                        <div class="icon-selection">
                            @foreach (config('icons') as $icon)
                                <div class="icon-item" data-icon="{{ $icon }}">
                                    <i class="{{ $icon }}"></i>
                                </div>
                            @endforeach
                        </div>
                    </div>

                    <!-- Hidden Input to store the selected icon -->
                    <input type="hidden" name="icon" id="selectedIcon" value="">

                    <!-- Icon Preview Area -->
                    <div class="icon-preview">
                        <i id="iconPreview" class="fas fa-tree"></i> <!-- Default icon -->
                    </div>

                    <div class="modal-actions">
                        <button type="submit" class="btn btn-primary">Save</button>
                        <button type="button" class="btn btn-secondary" onclick="closeAddCategoryForm()">Cancel</button>
                    </div>
                </form>
            </div>
        </div>

    </div>


    <!-- Edit Category Modal -->
    @if($categories->isEmpty())
    
@else
<div id="editCategoryForm" class="modal">
    <div class="modal-content">
        <span class="close-btn" onclick="closeEditCategoryForm()">×</span>
        <h3 class="modal-title">Edit Category</h3>
        <form action="{{ route('categories.update', $category->id) }}" method="POST">
            @csrf
            @method('PATCH')
            <div class="form-group">
                <label for="main_category">Main Category</label>
                <select name="main_category" id="main_category" required>
                    <option value="Courses" @if($category->main_category == 'Courses') selected @endif>Courses</option>
                    <option value="Course Type" @if($category->main_category == 'Course Type') selected @endif>Course Type</option>
                    <option value="Location" @if($category->main_category == 'Location') selected @endif>Location</option>
                    <option value="Duration" @if($category->main_category == 'Duration') selected @endif>Duration</option>
                    <option value="Course Format" @if($category->main_category == 'Course Format') selected @endif>Course Format</option>
                    <option value="Attendance Type" @if($category->main_category == 'Attendance Type') selected @endif>Attendance Type</option>
                </select>
            </div>
            <div class="form-group">
                <label for="name">Category Name</label>
                <input type="text" name="name" id="name" value="{{ $category->name }}" required>
            </div>

            <!-- Icon Selection -->
            <div class="form-group">
                <label for="icon">Select Icon:</label>
                <div class="icon-selection">
                    @foreach (config('icons') as $icon)
                        <div class="icon-item" data-icon="{{ $icon }}">
                            <i class="{{ $icon }}"></i>
                        </div>
                    @endforeach
                </div>
            </div>

            <!-- Hidden Input to store the selected icon -->
            <input type="hidden" name="icon" id="selectedIcon" value="{{ $category->icon }}">

            <!-- Icon Preview Area -->
            <div class="icon-preview">
                <i id="iconPreview" class="{{ $category->icon }}"></i>
            </div>

            <div class="modal-actions">
                <button type="submit" class="btn btn-primary">Save</button>
                <button type="button" class="btn btn-secondary" onclick="closeEditCategoryForm()">Cancel</button>
            </div>
        </form>
    </div>
</div>

@endif  
    <script>
            function toggleDropdown() {
    const dropdown = document.getElementById('dropdown-menu');
    dropdown.classList.toggle('show');
}

// Close the dropdown if clicked outside
window.addEventListener('click', function (event) {
    const dropdown = document.getElementById('dropdown-menu');
    const profileButton = document.querySelector('.profile-btn');

    if (!dropdown.contains(event.target) && !profileButton.contains(event.target)) {
        dropdown.classList.remove('show');
    }
});
        
        // Open and close add category form
        function openAddCategoryForm() {
            document.getElementById('addCategoryForm').style.display = 'flex';
        }

        function closeAddCategoryForm() {
            document.getElementById('addCategoryForm').style.display = 'none';
        }

        // Icon selection functionality
        document.querySelectorAll('.icon-item').forEach(item => {
            item.addEventListener('click', function() {
                let iconClass = item.getAttribute('data-icon');
                document.getElementById('iconPreview').className = iconClass;
                document.getElementById('selectedIcon').value = iconClass;

                document.querySelectorAll('.icon-item').forEach(i => i.classList.remove('selected'));
                item.classList.add('selected');
            });
        });

        // Open Edit Category Form Modal
    function openEditCategoryForm() {
        document.getElementById('editCategoryForm').style.display = 'flex';
    }

    // Close Edit Category Form Modal
    function closeEditCategoryForm() {
        document.getElementById('editCategoryForm').style.display = 'none';
    }

    // Icon selection functionality
    document.querySelectorAll('.icon-item').forEach(item => {
        item.addEventListener('click', function() {
            let iconClass = item.getAttribute('data-icon');
            document.getElementById('iconPreview').className = iconClass;
            document.getElementById('selectedIcon').value = iconClass;

            document.querySelectorAll('.icon-item').forEach(i => i.classList.remove('selected'));
            item.classList.add('selected');
        });
    });
    </script>
</body>
</html>
