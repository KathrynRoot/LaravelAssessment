<x-layout title="Welcome">
    <div class="mx-auto flex-col items-center justify-center p-5 mt-10">
        @guest
            <div class="my-auto text-2xl">
                <p>Please <a href="/login" class="underline">log in</a> to continue</p>
            </div>
        @endguest
        @auth
        <div class="flex flex-col items-center justify-center gap-x-2 gap-y-2">
            {{-- <div class="flex flex-col gap-y-2 mx-auto"> --}}
                <h2 class="text-xl text-center">Recently added companies</h2>
                @if($companies->count() > 0)
                <div class="mx-5 lg:mx-auto overflow-x-scroll border border-border rounded-t-md max-w-8/10">
                    <table class="w-full border-collapse">
                        <thead>
                            <tr>
                                <th scope="col" class="p-2" >Company Name</th>
                                <th scope="col" class="p-2 border-l border-r">Email</th>
                                <th scope="col" class="p-2 border-r">Website</th>
                                <th scope="col" class="p-2 border-r">Employees</th>
                                <th scope="col" class="p-2">Controls</th>
                            </tr>
                        </thead>
                        <tbody class="[&>*:nth-child(odd)]:bg-base-300">
                            @foreach ($companies as $company)
                            <div
                                class="bg-base-300 min-w-[250px] text-center p-4 rounded-md text-xl absolute left-1/2 lg:left-1/2 top-1/2 -translate-y-1/2
                                opacity-0 transition-all duration-300 ease-in delete-confirmation-msg hidden">
                                <form method="POST" action="{{ route('company.destroy', $company->id) }}" class="h-[25px]">
                                    @csrf
                                    @method('DELETE')
                                    <p class="mb-5">Are you sure you want to <span class="text-red-300">delete</span><strong> {{ $company->name }}?</strong></p>
                                    <button type="submit" class="btn btn-secondary h-[25px] w-[80px] p-4 mr-1">Confirm</button>
                                    <button type="button" class="btn h-[25px] w-[80px] p-4 cancel-delete ml-1">Cancel</button>
                                </form>
                            </div>
                                <tr class="border-t h-[75px]">
                                    <th scope="row" class="fill-white align-left">
                                        <div class="fill-white flex flex-row gap-x-2 p-3 items-center text-left justify-start">
                                            <img 
                                                src="{{ asset('storage/icons/' . $company->id . '.png') }}" 
                                                alt="Company Logo for {{ $company->name }}"
                                                class="max-w-5 max-h-5"
                                                >
                                                <a href="/companies/{{ $company->id }}" class="text-left break-words justify-self-start">{{ $company->name }}</a>
                                        </div>
                                    </th>
                                    <td scope="row" class="p-3 border-l border-r">
                                        <div>{{ $company->email }}</div>
                                    </td>

                                    <td scope="row" class="p-3 border-r">
                                        <div>{{ $company->website }}</div>
                                    </td>

                                    <td scope="row" class="p-3 border-r">
                                        <div>
                                            {{ $company->employees->count(); }}
                                        </div>
                                    </td>
                                    <td scope="row" class="align-middle">
                                        <div class="flex flex-row justify-center gap-x-1">
                                            <a href="/companies/{{ $company->id }}" class="btn text-primary h-[25px] w-[60px] p-1 border border-primary">View</a>
                                            <a href="/companies/{{ $company->id }}?trigger=modal" class="btn text-accent h-[25px] w-[60px] p-1 border border-accent">Edit</a>
                                            
                                            <button class="btn text-secondary h-[25px] w-[60px] p-1 delete-company border border-secondary">Delete</button>
                                        </div>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
                <a href="/companies" class="w-8/10 border rounded-md p-4 hover:underline mb-3 btn text-primary border border-primary">
                    Click here to view all {{ $companyCount }} companies
                </a>
            @endif
            {{-- </div> --}}

            {{-- <div class="flex flex-col gap-y-2 mx-auto"> --}}
                <h2 class="text-xl text-center">Recently added employees</h2>
                <div class="mx-5 lg:mx-auto overflow-x-scroll border border-border rounded-t-md max-w-8/10">
                    <table class="w-full border-collapse">
                        <thead>
                            <tr class="h-[55px]">
                                <th scope="col" class="p-2" >Name</th>
                                <th scope="col" class="p-2 border-l border-r">Company</th>
                                <th scope="col" class="p-2 border-r">Email</th>
                                <th scope="col" class="p-2 border-r">Number</th>
                                <th scope="col" class="p-2">Controls</th>
                            </tr>
                        </thead>
                        <tbody class="[&>*:nth-child(odd)]:bg-base-300">
                            @foreach ($employees as $employee)
                                <div
                                    class="bg-base-300 min-w-[250px] text-center p-4 rounded-md text-xl absolute left-1/2 lg:left-1/2 top-1/2 -translate-y-1/2
                                    opacity-0 transition-all duration-300 ease-in delete-confirmation-msg hidden">
                                    <form method="POST" action="{{ route('employee.destroy', $employee->id) }}" class="h-[25px]">
                                        @csrf
                                        @method('DELETE')
                                        <p class="mb-5">Are you sure you want to <span class="text-red-300">delete</span> <strong> {{ $employee->firstName }} {{ $employee->lastName }}? </strong></p>
                                        <button type="submit" class="btn btn-secondary h-[25px] w-[80px] p-4 mr-1">Confirm</button>
                                        <button type="button" class="btn h-[25px] w-[80px] p-4 cancel-delete ml-1">Cancel</button>
                                    </form>
                                </div>
                                <tr class="border-t">
                                    <th scope="row" class="fill-white align-middle">
                                        <div class="fill-white flex flex-row gap-x-2 p-3 items-center">
                                            <a href="/employees/{{ $employee->id }}">{{ $employee->first_name }} {{ $employee->last_name }}</a>
                                        </div>
                                    </th>

                                    <td scope="row" class="p-3 border-l border-r">
                                        <div>{{ $employee->company->id }}</div>

                                    </td>

                                    <td scope="row" class="p-3 border-r">
                                        <div>{{ $employee->email }}</div>

                                    </td>

                                    <td scope="row" class="p-3 border-r">
                                        <div>{{ $employee->number }}</div>
                                    </td>
                                    <td scope="row" class="align-middle">
                                        <div class="flex flex-row justify-center gap-x-1">
                                            <a href="/employees/{{ $employee->id }}" class="btn text-primary h-[25px] w-[60px] p-1 border border-primary">View</a>
                                            <a href="/employees/{{ $employee->id }}?trigger=modal" class="btn text-accent h-[25px] w-[60px] p-1 border border-accent">Edit</a>
                                            <button class="btn text-secondary h-[25px] w-[60px] p-1 delete-company border border-secondary">Delete</button>
                                        </div>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
                <a href="/employees" class="w-8/10 border rounded-md p-4 hover:underline mb-3 btn text-primary border border-primary">
                    Click here to view all {{ $employeeCount }} employees
                </a>
            {{-- </div> --}}
        </div>
        @endauth
    </div>
</x-layout>
