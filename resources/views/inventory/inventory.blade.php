@extends('layouts.app-layout')

@section('content')
    <div class="container mx-auto m-8 flex flex-col gap-10">
        <h1 class="text-3xl font-semibold">Inventory</h1>

        <!-- Dashboard -->
        <div class="flex justify-evenly">
            <div class="min-w-[350px] flex flex-col items-center gap-4 p-6 border rounded-2xl shadow-xl">
                <h3 class="text-2xl font-semibold">Medicines</h3>
                <div class="h-[200px] w-[200px]">
                    <div class="h-full w-full border bg-yellow-500 rounded-full"></div>
                </div>
                <div class="flex justify-center gap-8">
                    <div class="flex items-center gap-2 ">
                        <div class="bg-red-600 w-5 h-5"></div>
                        <p class="label">Nearly Expired</p>
                    </div>
                    <div class="flex items-center gap-2">
                        <div class="bg-lime-600 w-5 h-5"></div>
                        <p class="label">Remainings</p>
                    </div>
                </div>
            </div>

            <div class="min-w-[350px] flex flex-col items-center gap-4 p-4 border rounded-2xl shadow-xl">
                <h3 class="text-2xl font-semibold">Equipment</h3>
                <div class="h-[200px] w-[200px]">
                    <div class="h-full w-full border bg-yellow-500 rounded-full"></div>
                </div>
                <div class="flex justify-center gap-8">
                    <div class="flex items-center gap-2 ">
                        <div class="bg-red-600 w-5 h-5"></div>
                        <p class="label">Broken</p>
                    </div>
                    <div class="flex items-center gap-2">
                        <div class="bg-lime-600 w-5 h-5"></div>
                        <p class="label">Remainings</p>
                    </div>
                </div>
            </div>

            <div class="min-w-[350px] flex flex-col items-center gap-4 p-4 border rounded-2xl shadow-xl">
                <h3 class="text-2xl font-semibold">Medical Supplies</h3>
                <div class="h-[200px] w-[200px]">
                    <div class="h-full w-full border bg-yellow-500 rounded-full"></div>
                </div>
                <div class="flex justify-center gap-8">
                    <div class="flex items-center gap-2 ">
                        <div class="bg-red-600 w-5 h-5"></div>
                        <p class="label">Consumed</p>
                    </div>
                    <div class="flex items-center gap-2">
                        <div class="bg-lime-600 w-5 h-5"></div>
                        <p class="label">Remainings</p>
                    </div>
                </div>
            </div>
        </div>

        <div class="relative overflow-x-auto space-y-4">
            <!-- Choice Tabs -->
            <div class="flex justify-between items-center">
                <div class="flex items-center gap-8 text-xl">
                    <div
                        class="border border-slate-300 px-8 py-4 rounded-t-xl shadow-sm active:bg-gray-900 active:text-white hover:bg-gray-300 cursor-pointer">
                        <a href="">Medicines</a></div>
                    <div
                        class="border border-slate-300 px-8 py-4 rounded-t-xl shadow-sm active:bg-gray-900 active:text-white hover:bg-gray-300 cursor-pointer">
                        <a href="">Equipment</a></div>
                    <div
                        class="border border-slate-300 px-8 py-4 rounded-t-xl shadow-sm active:bg-gray-900 active:text-white hover:bg-gray-300 cursor-pointer">
                        <a href="">Medical Supplies</a></div>
                </div>

                <!-- Dialog with Form -->
                <div>
                    <button data-dialog-target="add-dialog"
                        class="w-28 h-[60px] rounded-lg bg-lime-600 py-2 px-4 mr-8 border border-transparent text-center text-lg font-semibold text-white transition-all shadow-md hover:shadow-lg focus:bg-lime-700 focus:shadow-none active:bg-lime-700 hover:bg-lime-700 active:shadow-none disabled:pointer-events-none disabled:opacity-50 disabled:shadow-none"
                        type="button">
                        Add
                    </button>
                    <div data-dialog-backdrop="add-dialog" data-dialog-backdrop-close="true"
                        class="pointer-events-none fixed inset-0 z-[999] grid h-screen w-screen place-items-center bg-black bg-opacity-60 opacity-0 backdrop-blur-sm transition-opacity duration-300">
                        <div data-dialog="add-dialog"
                            class="relative mx-auto w-full max-w-[40rem] rounded-lg overflow-hidden shadow-sm">
                            <div class="relative flex flex-col bg-white">
                                <button type="button" data-ripple-dark="true" data-dialog-close="true"
                                    class="self-end mt-8 mr-12 text-red-600 text-xl font-medium">X</button>
                                <!-- Form -->
                                <form method="" action="" class="flex flex-col gap-4 p-12">
                                    @csrf

                                    <div class="w-full flex justify-between gap-8">
                                        <div class="w-full max-w-sm min-w-[200px]">
                                            <label class="block mb-2 text-sm text-slate-600">
                                                Date Received
                                            </label>
                                            <input type="date"
                                                class="w-full bg-transparent text-slate-700 text-sm border border-slate-200 rounded-md px-3 py-2 transition duration-300 ease focus:outline-none focus:border-slate-400 hover:border-slate-300 shadow-sm focus:shadow"
                                                required />
                                        </div>
                                        <div class="w-full max-w-sm min-w-[200px]">
                                            <label class="block mb-2 text-sm text-slate-600">
                                                Expiry Date
                                            </label>
                                            <input type="date"
                                                class="w-full bg-transparent text-slate-700 text-sm border border-slate-200 rounded-md px-3 py-2 transition duration-300 ease focus:outline-none focus:border-slate-400 hover:border-slate-300 shadow-sm focus:shadow"
                                                required />
                                        </div>
                                    </div>

                                    <div class="w-full flex justify-between gap-8">
                                        <div class="w-full max-w-sm min-w-[200px]">
                                            <label class="block mb-2 text-sm text-slate-600">
                                                Medicine
                                            </label>
                                            <input type="text"
                                                class="w-full bg-transparent placeholder:text-slate-400 text-slate-700 text-sm border border-slate-200 rounded-md px-3 py-2 transition duration-300 ease focus:outline-none focus:border-slate-400 hover:border-slate-300 shadow-sm focus:shadow"
                                                placeholder="Paracetamol 500mg" required />
                                        </div>
                                        <div class="w-full max-w-sm min-w-[200px]">
                                            <label class="block mb-2 text-sm text-slate-600">
                                                Stock #
                                            </label>
                                            <input type="text"
                                                class="w-full bg-transparent placeholder:text-slate-400 text-slate-700 text-sm border border-slate-200 rounded-md px-3 py-2 transition duration-300 ease focus:outline-none focus:border-slate-400 hover:border-slate-300 shadow-sm focus:shadow"
                                                placeholder="##-###" required />
                                        </div>
                                    </div>

                                    <div class=" flex justify-space-between gap-8">
                                        <div class="w-full max-w-sm min-w-[200px]">
                                            <label class="block mb-2 text-sm text-slate-600">
                                                Unit
                                            </label>
                                            <div class="flex items-center justify-center gap-8">
                                                <div class="flex items-center">
                                                    <input id="default-radio-1" type="radio" value=""
                                                        name="default-radio"
                                                        class="w-4 h-4 text-blue-600 bg-gray-100 border-gray-300 focus:ring-blue-500 dark:focus:ring-blue-600 dark:ring-offset-gray-800 focus:ring-2 dark:bg-gray-700 dark:border-gray-600">
                                                    <label for="default-radio-1"
                                                        class="ms-2 text-sm font-medium text-gray-900 dark:text-gray-300">Capsule</label>
                                                </div>
                                                <div class="flex items-center">
                                                    <input checked id="default-radio-2" type="radio" value=""
                                                        name="default-radio"
                                                        class="w-4 h-4 text-blue-600 bg-gray-100 border-gray-300 focus:ring-blue-500 dark:focus:ring-blue-600 dark:ring-offset-gray-800 focus:ring-2 dark:bg-gray-700 dark:border-gray-600">
                                                    <label for="default-radio-2"
                                                        class="ms-2 text-sm font-medium text-gray-900 dark:text-gray-300">Tablet</label>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="w-full max-w-sm min-w-[200px]">
                                            <label class="block mb-2 text-sm text-slate-600">
                                                Quantity
                                            </label>
                                            <input type="number"
                                                class="w-full bg-transparent placeholder:text-slate-400 text-slate-700 text-sm border border-slate-200 rounded-md px-3 py-2 transition duration-300 ease focus:outline-none focus:border-slate-400 hover:border-slate-300 shadow-sm focus:shadow"
                                                min="1" placeholder="200" required />
                                        </div>
                                    </div>

                                    <div class="w-full flex justify-between gap-8">
                                        <div class="w-full max-w-sm min-w-[200px]">
                                            <label class="block mb-2 text-sm text-slate-600">
                                                Consumed
                                            </label>
                                            <input type="number"
                                                class="w-full bg-transparent placeholder:text-slate-400 text-slate-700 text-sm border border-slate-200 rounded-md px-3 py-2 transition duration-300 ease focus:outline-none focus:border-slate-400 hover:border-slate-300 shadow-sm focus:shadow"
                                                min="0" placeholder="150" required />
                                        </div>
                                        <div class="w-full max-w-sm min-w-[200px]">
                                            <label class="block mb-2 text-sm text-slate-600">
                                                Balance
                                            </label>
                                            <input type="number"
                                                class="w-full bg-transparent placeholder:text-slate-400 text-slate-700 text-sm border border-slate-200 rounded-md px-3 py-2 transition duration-300 ease focus:outline-none focus:border-slate-400 hover:border-slate-300 shadow-sm focus:shadow"
                                                min="0" placeholder="50" required />
                                        </div>
                                    </div>

                                    <div class="w-full flex justify-between gap-8">
                                        <div class="w-full max-w-sm min-w-[200px]">
                                            <label class="block mb-2 text-sm text-slate-600">
                                                Supplier
                                            </label>
                                            <input type="text"
                                                class="w-full bg-transparent placeholder:text-slate-400 text-slate-600 text-sm border border-slate-200 rounded-md px-3 py-2 transition duration-300 ease focus:outline-none focus:border-slate-400 hover:border-slate-300 shadow-sm focus:shadow"
                                                placeholder="Main Campus" required />
                                        </div>
                                        <div class="w-full max-w-sm min-w-[200px]">
                                            <label for="countries"
                                                class="block mb-2 text-sm  text-slate-600 dark:text-white">Memorandum
                                                Receipt</label>
                                            <select id="countries"
                                                class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                                                required>
                                                <option value="US">User 1</option>
                                                <option value="CA">User 2</option>
                                            </select>
                                        </div>
                                    </div>
                                    <button
                                        class="self-center w-1/4 rounded-md bg-lime-600 py-2 px-4 border border-transparent text-center text-lg text-white transition-all shadow-md hover:shadow-lg focus:bg-lime-700 focus:shadow-none active:bg-lime-700 hover:bg-lime-700 active:shadow-none disabled:pointer-events-none disabled:opacity-50 disabled:shadow-none"
                                        type="submit">
                                        Save
                                    </button>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Table -->
            <table class="w-full text-sm text-left rtl:text-right text-gray-500 dark:text-gray-400">
                <thead class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
                    <tr>
                        <th scope="col" class="px-6 py-3">
                            Date Received
                        </th>
                        <th scope="col" class="px-6 py-3">
                            Stock #
                        </th>
                        <th scope="col" class="px-6 py-3">
                            Medicine
                        </th>
                        <th scope="col" class="px-6 py-3">
                            Unit
                        </th>
                        <th scope="col" class="px-6 py-3">
                            Quantity
                        </th>
                        <th scope="col" class="px-6 py-3">
                            Consumed
                        </th>
                        <th scope="col" class="px-6 py-3">
                            Balance
                        </th>
                        <th scope="col" class="px-6 py-3">
                            Expiry Date
                        </th>
                        <th scope="col" class="px-6 py-3">
                            Supplier
                        </th>
                        <th scope="col" class="px-6 py-3">
                            Memorandum Receipt
                        </th>
                        <th scope="col" class="px-6 py-3">
                            Actions
                        </th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($medicines as $medicine)
                        <tr class="bg-white border-b dark:bg-gray-800 dark:border-gray-700 hover:bg-gray-50">
                            <th scope="row"
                                class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                                {{ $medicine['dateReceived'] }}
                            </th>
                            <td class="px-6 py-4">
                                {{ $medicine['stockNumber'] }}
                            </td>
                            <td class="px-6 py-4">
                                {{ $medicine['name'] }}
                            </td>
                            <td class="px-6 py-4">
                                {{ $medicine['unit'] }}
                            </td>
                            <td class="px-6 py-4">
                                {{ $medicine['quantity'] }}
                            </td>
                            <td class="px-6 py-4">
                                {{ $medicine['consumed'] }}
                            </td>
                            <td class="px-6 py-4">
                                {{ $medicine['balance'] }}
                            </td>
                            <td class="px-6 py-4">
                                {{ $medicine['expiryDate'] }}
                            </td>
                            <td class="px-6 py-4">
                                {{ $medicine['supplier'] }}
                            </td>
                            <td class="px-6 py-4">
                                {{ $medicine['memorandumReceipt'] }}
                            </td>
                            <td class="px-6 py-4">
                                <div class="flex justify-center gap-2">
                                    <div class="px-4 py-2 bg-yellow-500 hover:bg-yellow-600 rounded-lg"><a href=""
                                            class="text-white">Edit</a></div>
                                    <div class="px-4 py-2 bg-red-500 hover:bg-red-600 rounded-lg"><a href=""
                                            class="text-white">Delete</a></div>
                                </div>
                            </td>
                        </tr>
                    @endforeach

                    {{-- <tr class="bg-white border-b dark:bg-gray-800 dark:border-gray-700 hover:bg-gray-50">
                    <th scope="row" class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                        8/12/24
                    </th>
                    <td class="px-6 py-4">
                        16-003
                    </td>
                    <td class="px-6 py-4">
                        Paracetamol 500mg
                    </td>
                    <td class="px-6 py-4">
                        Tablet
                    </td>
                    <td class="px-6 py-4">
                        486
                    </td>
                    <td class="px-6 py-4">
                        48
                    </td>
                    <td class="px-6 py-4">
                        448
                    </td>
                    <td class="px-6 py-4">
                        Oct '25
                    </td>
                    <td class="px-6 py-4">
                        Main Campus
                    </td>
                    <td class="px-6 py-4">
                        Melissa P. Sarapuddin, MD
                    </td>
                    <td class="px-6 py-4">
                        <div class="flex justify-center gap-2">
                            <div class="px-4 py-2 bg-yellow-500 hover:bg-yellow-600 rounded-lg"><a href="" class="text-white">Edit</a></div>
                            <div class="px-4 py-2 bg-red-500 hover:bg-red-600 rounded-lg"><a href="" class="text-white">Delete</a></div>
                        </div>
                    </td>
                </tr> --}}

                </tbody>
            </table>
        </div>
    </div>
@endsection
