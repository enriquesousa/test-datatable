<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Dashboard') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">

                    {{-- <table class="table">
                        <thead>
                            <tr>
                                <th scope="col">#</th>
                                <th>Name</th>
                                <th>Email</th>
                                <th>Created_at</th>
                                <th>Updated_at</th>
                            </tr>
                        </thead>

                        <tbody>

                            @forelse ( $users as $user )
                                <tr>
                                    <td>{{ $user->id }}</td>
                                    <td>{{ $user->name }}</td>
                                    <td>{{ $user->email }}</td>
                                    <td>{{ $user->created_at }}</td>
                                    <td>{{ $user->updated_at }}</td>
                                </tr>
                            @empty
                                <tr colspan="5" class="text-center">
                                    <td>No users found</td>
                                </tr>
                            @endforelse

                        </tbody>
                    </table>

                    <div>
                        {{ $users->links() }}
                    </div> --}}

                    {{ $dataTable->table() }}


                </div>
            </div>
        </div>
    </div>

    {{ $dataTable->scripts(attributes: ['type' => 'module']) }}
    
</x-app-layout>
