@extends('layouts.app')
@section('content')
    <div class="container p-6 bg-white flex gap-[16px]">
        <div class=" px-4 py-4 bg-blue-500 rounded-full w-[150px] h-[50px] ">
            <p class="text-center text-[15px] text-right text-white">Add Post</p>
        </div>
        <div class="bg-white px-3 py-4 items-center absolute rounded-full text-left">
            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor"
                class="size-6">
                <path stroke-linecap="round" stroke-linejoin="round"
                    d="m16.862 4.487 1.687-1.688a1.875 1.875 0 1 1 2.652 2.652L10.582 16.07a4.5 4.5 0 0 1-1.897 1.13L6 18l.8-2.685a4.5 4.5 0 0 1 1.13-1.897l8.932-8.931Zm0 0L19.5 7.125M18 14v4.75A2.25 2.25 0 0 1 15.75 21H5.25A2.25 2.25 0 0 1 3 18.75V8.25A2.25 2.25 0 0 1 5.25 6H10" />
            </svg>
        </div>

        <div class="px-5 py-5 bg-blue-500 rounded-full w-[160px] h-[50px] flex items-center gap-4 ">
            <p class="text-[15px] text-white">Categories</p>

            <div class="w-px h-[12px] md:h-10 border border-white"></div>
            <div>
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                    stroke="currentColor" class="size-6 text-white">
                    <path stroke-linecap="round" stroke-linejoin="round"
                        d="M2.25 12.75V12A2.25 2.25 0 0 1 4.5 9.75h15A2.25 2.25 0 0 1 21.75 12v.75m-8.69-6.44-2.12-2.12a1.5 1.5 0 0 0-1.061-.44H4.5A2.25 2.25 0 0 0 2.25 6v12a2.25 2.25 0 0 0 2.25 2.25h15A2.25 2.25 0 0 0 21.75 18V9a2.25 2.25 0 0 0-2.25-2.25h-5.379a1.5 1.5 0 0 1-1.06-.44Z" />
                </svg>
            </div>
        </div>

        <div class="w-[96px] h-[50px] bg-[#8989FC] rounded-full absolute right-10">
            <p class="mx-auto px-3 py-4 text-center text-[16px] ">Search</p>
        </div>
        <div class="max-w-lg border border-slate-600 rounded-xl absolute right-40">
            <form action="#" class="flex items-center border border-gray-300 rounded-lg overflow-hidden bg-white">
                <div class="px-3 text-gray-500">
                    <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5" fill="none" viewBox="0 0 24 24"
                        stroke="currentColor" stroke-width="1.5">
                        <path stroke-linecap="round" stroke-linejoin="round"
                            d="M21 21l-5.197-5.197m0 0a7.5 7.5 0 1 0-10.607-10.607 7.5 7.5 0 0 0 10.607 10.607z" />
                    </svg>
                </div>

                <input type="text" name="search" id="search" placeholder="Search"
                    class="py-2 pr-4 text-sm outline-none w-full" />
            </form>

        </div>

        <input type="checkbox" name="remember" class="w-[18px] h-[18px] text-[#3030F84D]"></input>

    </div>
@endsection
