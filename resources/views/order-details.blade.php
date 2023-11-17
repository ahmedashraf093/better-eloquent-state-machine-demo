<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>Laravel</title>

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,600&display=swap" rel="stylesheet" />

    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.16/dist/tailwind.min.css" rel="stylesheet">
</head>

<body class="antialiased">
    <div
        class="relative sm:flex sm:justify-center sm:items-center min-h-screen bg-dots-darker bg-center bg-gray-100 dark:bg-dots-lighter dark:bg-gray-900 selection:bg-red-500 selection:text-white">

        <div>

            <div style="width: 600px;"
                class="bg-white flex w-full dark:bg-gray-800/50 dark:bg-gradient-to-bl from-gray-700/50 via-transparent dark:ring-1 dark:ring-inset dark:ring-white/5 rounded-lg shadow-2xl shadow-gray-500/20 dark:shadow-none  motion-safe:hover:scale-[1.01] transition-all duration-250 focus:outline focus:outline-2 focus:outline-red-500">
                <h2 class="text-xl p-4 font-semibold text-gray-900 dark:text-white bg-gray-200">Order Details</h2>

                <dl class="space-y-2 mt-4 p-4">
                    <div>
                        <dt class="text-sm font-medium text-gray-500">Order ID:</dt>
                        <dd class="text-sm text-gray-900">{{ $firstOrder->id }}</dd>
                    </div>

                    <div>
                        <dt class="text-sm font-medium text-gray-500">Order Amount:</dt>
                        <dd class="text-sm text-gray-900">{{ $firstOrder->total_amount }}</dd>
                    </div>

                    <div>
                        <dt class="text-sm font-medium text-gray-500">Payment:</dt>
                        <dd class="text-sm text-gray-900">{{ $firstOrder->payment_method }}</dd>
                    </div>

                    <div>
                        <dt class="text-sm font-medium text-gray-500">Billing Address:</dt>
                        <dd class="text-sm text-gray-900">{{ $firstOrder->billing_address }}</dd>
                    </div>

                    <div>
                        <dt class="text-sm font-medium text-gray-500">Order Status:</dt>
                        <dd class="text-sm text-gray-900"><span
                                class="inline-block 
                                    p-2
                                    mt-2
                                    @switch($firstOrder->status)
                                        @case('pending')
                                            bg-yellow-100 text-yellow-800
                                        @break
                                        @case('processing')
                                            bg-blue-100 text-blue-800
                                        @break
                                        @case('completed')
                                            bg-green-100 text-green-800
                                        @break
                                        @case('cancelled')
                                            bg-red-100 text-red-800
                                        @break
                                        @case('refunded')
                                            bg-red-100 text-red-800
                                        @break
                                        @case('declined')
                                            bg-red-100 text-red-800
                                        @break
                                    
                                        @default
                                         bg-yellow-100 text-yellow-800

                                    @endswitch

                                 text-xs px-2 rounded-full uppercase font-semibold tracking-wide">
                                {{ $firstOrder->status }}
                            </span>
                        </dd>
                    </div>
                </dl>
            </div>

            <div class="block d:block"></div>

            <div style="width: 600px;"
                class="bg-white flex w-full mt-4 dark:bg-gray-800/50 dark:bg-gradient-to-bl from-gray-700/50 via-transparent dark:ring-1 dark:ring-inset dark:ring-white/5 rounded-lg shadow-2xl shadow-gray-500/20 dark:shadow-none  motion-safe:hover:scale-[1.01] transition-all duration-250 focus:outline focus:outline-2 focus:outline-red-500">
                <h2 class="text-xl p-4 font-semibold text-gray-900 dark:text-white bg-gray-200">Update Status</h2>

                <form class="space-y-4 p-4" method="post" action="/updateorder">
                    @csrf
                    <div>
                        <input type="hidden" name="order_id" value="{{ $firstOrder->id }}">
                        <label for="status" class="block text-sm font-medium text-gray-700">Status</label>
                        <select id="status" name="status"
                            class="mt-1 block w-full py-2 px-3 border border-gray-300 bg-white rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm">

                            @foreach ($firstOrder->status()->stateMachine->availableTransitions() as $availableState)
                                <option value="{{ $availableState }}">{{ $availableState }}</option>
                            @endforeach
                        </select>
                    </div>

                    <div>
                        <label for="comments" class="block text-sm font-medium text-gray-700">comments</label>
                        <textarea id="comments" name="comments" rows="3"
                            class="mt-1 block w-full py-2 px-3 border border-gray-300 bg-white rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm"></textarea>
                    </div>

                    <div>
                        <button type="submit"
                            class="inline-flex justify-center py-2 px-4 border border-transparent shadow-sm text-sm font-medium rounded-md text-white bg-indigo-600 hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">
                            Update Status
                        </button>
                    </div>
                </form>
            </div>

            <div class="block d:block"></div>

            <table style="width: 600px;" class="min-w-full divide-y divide-gray-200 mt-4">
                <thead class="bg-gray-50">
                    <tr>
                        <th scope="col"
                            class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                            Status From
                        </th>

                        <th scope="col"
                            class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                            Status To
                        </th>

                        <th scope="col"
                            class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                            Comment
                        </th>


                        <th scope="col"
                            class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                            Date
                        </th>
                    </tr>
                </thead>
                <tbody class="bg-white divide-y divide-gray-200">

                    @foreach ($firstOrder->status()->history()->get() as $entery)
                        <tr>
                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                                {{ $entery->from }}
                            </td>

                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                                {{ $entery->to }}
                            </td>

                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                                {{ @$entery->custom_properties['comments'] }}
                            </td>

                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                                {{ $entery->created_at->format('m-Y') }}
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>

        </div>
    </div>
</body>

</html>
