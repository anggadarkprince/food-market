<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {!! __('Users &raquo; Show') !!}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white sm:rounded-md shadow-sm p-6 mb-4">
                <div class="grid sm:grid-cols-2 gap-5">
                    <div class="flex flex-wrap -mx-3">
                        <div class="w-full px-3">
                            <p class="block uppercase text-indigo-500 text-xs font-bold mb-1">
                                Name
                            </p>
                            <p>{{ $user->name }}</p>
                        </div>
                    </div>
                    <div class="flex flex-wrap -mx-3">
                        <div class="w-full px-3">
                            <p class="block uppercase text-indigo-500 text-xs font-bold mb-1">
                                Email
                            </p>
                            <p>{{ $user->email }}</p>
                        </div>
                    </div>
                    <div class="flex flex-wrap -mx-3">
                        <div class="w-full px-3">
                            <p class="block uppercase text-indigo-500 text-xs font-bold mb-1">
                                Name
                            </p>
                            <p>{{ $user->role }}</p>
                        </div>
                    </div>
                    <div class="flex flex-wrap -mx-3">
                        <div class="w-full px-3">
                            <p class="block uppercase text-indigo-500 text-xs font-bold mb-1">
                                Email
                            </p>
                            <p>{{ $user->address }}</p>
                        </div>
                    </div>
                    <div class="flex flex-wrap -mx-3">
                        <div class="w-full px-3">
                            <p class="block uppercase text-indigo-500 text-xs font-bold mb-1">
                                City
                            </p>
                            <p>{{ $user->city }}</p>
                        </div>
                    </div>
                    <div class="flex flex-wrap -mx-3">
                        <div class="w-full px-3">
                            <p class="block uppercase text-indigo-500 text-xs font-bold mb-1">
                                Country
                            </p>
                            <p>{{ $user->country }}</p>
                        </div>
                    </div>
                    <div class="flex flex-wrap -mx-3">
                        <div class="w-full px-3">
                            <p class="block uppercase text-indigo-500 text-xs font-bold mb-1">
                                Phone Number
                            </p>
                            <p>{{ $user->phone_number }}</p>
                        </div>
                    </div>
                    <div class="flex flex-wrap -mx-3">
                        <div class="w-full px-3">
                            <p class="block uppercase text-indigo-500 text-xs font-bold mb-1">
                                Created At
                            </p>
                            <p>{{ $user->created_at }}</p>
                        </div>
                    </div>
                </div>
            </div>
            <div class="bg-white sm:rounded-md shadow-sm p-4 mb-4 text-center sm:text-left">
                <p class="block uppercase text-indigo-500 text-xs font-bold mb-2">
                    Photo Profile
                </p>
                <img src="{{ url($user->profile_photo_url) }}" class="w-32 h-32 object-cover rounded-md inline-block mr-2" alt="Photo">
            </div>
        </div>
    </div>
</x-app-layout>
