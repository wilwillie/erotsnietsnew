@extends('layouts.admin')

@section('title', 'Admin - Manage Dangerous Accounts')

@section('content')
    <div class="container py-5">
        <h1 class="mb-4 text-warning fw-bold">Manage Dangerous Accounts</h1>

        <div class="mb-4">
            <a href="{{ route('admin.dangerous_accounts.create') }}" class="btn btn-warning mb-3">Add New Dangerous
                Account</a>

            <form method="GET" action="{{ route('admin.dangerous_accounts.index') }}" class="row g-2 mb-3">
                <div class="col-12 col-md-3">
                    <label for="search" class="d-block mb-1">&nbsp;</label>
                    <input type="text" name="search" value="{{ request('search') }}" placeholder="Search..."
                        class="form-control w-100" autocomplete="off">
                </div>
                <div class="col-12 col-md-3">
                    <label for="sort_by" class="fw-semibold text-warning d-block mb-1">Sort By:</label>
                    <select name="sort_by" id="sort_by" class="form-select w-100">
                        <option value="tanggal_kejadian" {{ $sortBy == 'tanggal_kejadian' ? 'selected' : '' }}>Tanggal
                            Kejadian</option>
                        <option value="ml_id" {{ $sortBy == 'ml_id' ? 'selected' : '' }}>ML ID</option>
                        <option value="server_id" {{ $sortBy == 'server_id' ? 'selected' : '' }}>Server ID</option>
                        <option value="pelaku_nickname" {{ $sortBy == 'pelaku_nickname' ? 'selected' : '' }}>Pelaku Nickname
                        </option>
                        <option value="korban_nickname" {{ $sortBy == 'korban_nickname' ? 'selected' : '' }}>Korban Nickname
                        </option>
                        <option value="created_at" {{ $sortBy == 'created_at' ? 'selected' : '' }}>Created At</option>
                        <option value="updated_at" {{ $sortBy == 'updated_at' ? 'selected' : '' }}>Updated At</option>
                    </select>
                </div>
                <div class="col-12 col-md-3">
                    <label for="sort_order" class="d-block mb-1">&nbsp;</label>
                    <select name="sort_order" id="sort_order" class="form-select w-100">
                        <option value="asc" {{ $sortOrder == 'asc' ? 'selected' : '' }}>Ascending</option>
                        <option value="desc" {{ $sortOrder == 'desc' ? 'selected' : '' }}>Descending</option>
                    </select>
                </div>
                <div class="col-12 col-md-3">
                    <label for="submit" class="d-block mb-1">&nbsp;</label>
                    <button type="submit" class="btn btn-warning text-black fw-semibold w-100">Sort</button>
                </div>
            </form>
        </div>

        @if(session('success'))
            <div class="alert alert-success">{{ session('success') }}</div>
        @endif

        @if($dangerousAccounts->isEmpty())
            <p>No dangerous accounts found.</p>
        @else
            <div class="table-responsive">
                <table class="table table-hover align middle">
                    <thead>
                        <tr>
                            <th>ML ID</th>
                            <th>Server ID</th>
                            <th>Pelaku Nickname</th>
                            <th>Korban Nickname</th>
                            <th>Tanggal Kejadian</th>
                            <th>Created At</th>
                            <th>Updated At</th>
                            <th>Kronologi</th>
                            <th class="text-center">Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($dangerousAccounts as $account)
                            <tr>
                                <td data-label="ML ID">{{ $account->ml_id }}</td>
                                <td data-label="Server ID">{{ $account->server_id }}</td>
                                <td data-label="Pelaku Nickname">{{ $account->pelaku_nickname }}</td>
                                <td data-label="Korban Nickname">{{ $account->korban_nickname }}</td>
                                <td data-label="Tanggal Kejadian">{{ \Carbon\Carbon::parse($account->tanggal_kejadian)->format('d-m-Y') }}</td>
                                <td data-label="Created At">{{ \Carbon\Carbon::parse($account->created_at)->format('d-m-Y') }}</td>
                                <td data-label="Updated At">{{ \Carbon\Carbon::parse($account->updated_at)->format('d-m-Y') }}</td>
                                <td data-label="Kronologi">{{ $account->kronologi }}</td>
                                <td data-label="Actions" class="text-center">
                                    <a href="{{ route('admin.dangerous_accounts.edit', $account->id) }}"
                                        class="btn btn-warning btn-sm mb-1" title="Edit">
                                        <i class="fas fa-edit text-white"></i>
                                    </a>
                                    @if(!$account->is_accepted)
                                        <form action="{{ route('admin.dangerous_accounts.accept', $account->id) }}" method="POST"
                                            class="d-inline-block mb-1">
                                            @csrf
                                            <button type="submit" class="btn btn-success btn-sm mb-1" title="Accept Report">
                                                <i class="fas fa-check"></i> Accept
                                            </button>
                                        </form>
                                    @endif
                                    <form action="{{ route('admin.dangerous_accounts.destroy', $account->id) }}" method="POST"
                                        class="d-inline-block mb-1"
                                        onsubmit="return confirm('Are you sure you want to delete this dangerous account?');">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-danger btn-sm" title="Delete">
                                            <i class="fas fa-trash"></i>
                                        </button>
                                    </form>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
                {{ $dangerousAccounts->appends(request()->query())->links('pagination::bootstrap-5') }}
            </div>
        @endif
    </div>
@endsection

<style>
    /* Additional custom styles */
    .container {
        margin-top: 20px;
    }
    
        /* Make table cells stack on very small screens for better mobile view */
        
    @media (max-width: 575.98px) {
        table.table thead {
            display: none;
        }

        table.table tbody tr {
            display: block;
            margin-bottom: 1rem;
            border: 1px solid #dee2e6;
            border-radius: 0.25rem;
            padding: 0.75rem;
        }

        table.table tbody tr td {
            display: flex;
            justify-content: space-between;
            padding: 0.375rem 0.75rem;
            border: none;
            border-bottom: 1px solid #dee2e6;
            position: relative;
        }

        table.table tbody tr td:last-child {
            border-bottom: 0;
        }

        table.table tbody tr td::before {
            content: attr(data-label);
            font-weight: 600;
            text-transform: uppercase;
            flex: 1 1 50%;
        }

        table.table tbody tr td:last-child {
            justify-content: center;
            flex-wrap: wrap;
        }

        table.table tbody tr td:last-child form,
        table.table tbody tr td:last-child a {
            margin: 0 0.15rem 0.3rem 0.15rem;
        }
    }
</style>