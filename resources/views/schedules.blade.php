<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="/css/app.css">
    <title>Maker Calender</title>
</head>
<body class="font-mono">

<div id="app">
    <div class="flex bg-white w-full justify-content-between p-4">
        <div class="w-full">
            {{--add the real month and year and date--}}
            <p class="text-4xl font-bold text-gray-800 mb-8">@{{current_month}} @{{current_day}}</p>
            <div class="w-full">
                <div class="grid grid-cols-7 w-full mb-4">
                    {{--                    add days loop--}}
                    <p class="w-12 h-full text-sm font-bold text-gray-800 font-mono">Sun</p>
                    <p class="w-12 h-full text-sm font-bold text-gray-800 font-mono">Mon</p>
                    <p class="w-12 h-full text-sm font-bold text-gray-800 font-mono">Tue</p>
                    <p class="w-12 h-full text-sm font-bold text-gray-800 font-mono">Wed</p>
                    <p class="w-12 h-full text-sm font-bold text-gray-800 font-mono">Thu</p>
                    <p class="w-12 h-full text-sm font-bold text-gray-800 font-mono">Fri</p>
                    <p class="w-12 h-full text-sm font-bold text-gray-800 font-mono">Sat</p>
                </div>
                <div class="">
                    <div class="grid grid-cols-7 w-full">
                        {{--                        at click a modal opens to choose startups name the starting our and the dats--}}
                        <div v-for="days in days_in_month"
                             @click="pickDay"
                             class="flex cursor-pointer items-start justify-start h-full pl-2 pr-32 pt-2.5 pb-24 border border-gray-200">
                            <p :class="days == current_day ? 'bg-yellow-300 rounded-full py-1 px-3' : ''"
                               class="text-sm font-mono text-gray-800">@{{ days }}</p>
                        </div>

                    </div>
                </div>
            </div>
        </div>
        <div class="w-3/12">
            {{--here all the reservations will be shown --}}
            {{--add startup image logo next to their reservstion--}}
            {{--add startup image logo next to their reservstion--}}
            {{--add days switching between the days so they can see days ahead--}}
            days menu
        </div>
    </div>

    <!-- This example requires Tailwind CSS v2.0+ -->
    <div v-if="show_modal" class="fixed z-10 inset-0 overflow-y-auto" aria-labelledby="modal-title" role="dialog"
         aria-modal="true">
        <div class="flex items-end justify-center min-h-screen pt-4 px-4 pb-20 text-center sm:block sm:p-0">

            <div class="fixed inset-0 bg-gray-500 bg-opacity-75 transition-opacity" aria-hidden="true"></div>

            <!-- This element is to trick the browser into centering the modal contents. -->
            <span class="hidden sm:inline-block sm:align-middle sm:h-screen" aria-hidden="true">&#8203;</span>

            <!--
              Modal panel, show/hide based on modal state.

              Entering: "ease-out duration-300"
                From: "opacity-0 translate-y-4 sm:translate-y-0 sm:scale-95"
                To: "opacity-100 translate-y-0 sm:scale-100"
              Leaving: "ease-in duration-200"
                From: "opacity-100 translate-y-0 sm:scale-100"
                To: "opacity-0 translate-y-4 sm:translate-y-0 sm:scale-95"
            -->
            <div class="inline-block align-bottom bg-white rounded-lg text-left overflow-hidden shadow-xl transform transition-all sm:my-8 sm:align-middle sm:max-w-lg sm:w-full">
                <div class="bg-white px-4 pt-5 pb-4 sm:p-6 sm:pb-4">
                    <div class="">

                        <div class="mt-3 text-center sm:mt-0 sm:ml-4 sm:text-left">
                            <h3 class="text-lg leading-6 font-medium text-gray-900" id="modal-title">
                                Your reservation
                            </h3>
                            <div class="flex flex-col w-full mt-2">
                                <form action="/reserve" method="post">
                                    @csrf
                                    <input type="text" placeholder="Full Name" name="name"
                                           class="px-3 py-2 bg-white border mt-6 border-gray-300 focus:border-blue-500 rounded-md w-full">

                                    <select @change="onChangeRoom" v-model="room" type="text" name="room"
                                            class="px-3 py-2 bg-white border mt-6 border-gray-300 focus:border-blue-500 rounded-md w-full">
                                        <option value="Meeting room">Meeting room</option>
                                        <option value="Training room A">Training room A</option>
                                        <option value="Training room B">Training room B</option>
                                        <option value="Maker space training area">Maker space training area</option>
                                    </select>

                                    <div v-if="is_training" class="mt-6">
                                        <span class="text-gray-600">Reservation type</span>
                                        <div class="mt-2">
                                            <label class="inline-flex items-center">
                                                <input type="radio" class="form-radio" name="accountType">
                                                <span @click="is_repetitive = true" class="ml-2">Repetitive each <span
                                                            class="font-bold">@{{ current_day_name }}</span></span>
                                            </label>
                                            <label class="inline-flex items-center ml-6">
                                                <input type="radio" class="form-radio" name="accountType">
                                                <span @click="is_repetitive = false" class="ml-2">Not repetitive</span>
                                            </label>
                                        </div>
                                    </div>


                                    <input v-if="is_repetitive" type="number" placeholder="Weeks" name="weeks"
                                           class="px-3 py-2 bg-white border mt-6 border-gray-300 focus:border-blue-500 rounded-md w-full">

                                    <div class="flex justify-between items-center mt-6">
                                        From
                                        <div class="flex bg-gray-200 rounded-md px-3 py-2">
                                            <select name="from_hours"
                                                    class="bg-transparent appearance-none outline-none">
                                                <option value="1">1</option>
                                                <option value="2">2</option>
                                                <option value="3">3</option>
                                                <option value="4">4</option>
                                                <option value="5">5</option>
                                                <option value="6">6</option>
                                                <option value="7">7</option>
                                                <option value="8">8</option>
                                                <option value="9">9</option>
                                                <option value="10">10</option>
                                                <option value="11">10</option>
                                                <option value="12">12</option>
                                            </select>
                                            <span class="text-xl mr-3">:</span>
                                            <select name="from_minutes"
                                                    class="bg-transparent appearance-none outline-none mr-4">
                                                <option value="0">00</option>
                                                <option value="30">15</option>
                                                <option value="30">30</option>
                                                <option value="30">45</option>

                                            </select>
                                            <select name="from_ampm"
                                                    class="bg-transparent appearance-none outline-none">
                                                <option value="am">AM</option>
                                                <option value="pm">PM</option>
                                            </select>
                                        </div>
                                        To
                                        <div class="flex bg-gray-200 rounded-md px-3 py-2">
                                            <select name="to_hours" class="bg-transparent appearance-none outline-none">
                                                <option value="1">1</option>
                                                <option value="2">2</option>
                                                <option value="3">3</option>
                                                <option value="4">4</option>
                                                <option value="5">5</option>
                                                <option value="6">6</option>
                                                <option value="7">7</option>
                                                <option value="8">8</option>
                                                <option value="9">9</option>
                                                <option value="10">10</option>
                                                <option value="11">10</option>
                                                <option value="12">12</option>
                                            </select>
                                            <span class="text-xl mr-3">:</span>
                                            <select name="to_minutes"
                                                    class="bg-transparent appearance-none outline-none mr-4">
                                                <option value="0">00</option>
                                                <option value="30">15</option>
                                                <option value="30">30</option>
                                                <option value="30">45</option>

                                            </select>
                                            <select name="to_ampm" class="bg-transparent appearance-none outline-none">
                                                <option value="am">AM</option>
                                                <option value="pm">PM</option>
                                            </select>
                                        </div>
                                    </div>


                                </form>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="bg-gray-50 px-4 py-3 sm:px-6 sm:flex sm:flex-row-reverse">
                    <button type="submit"
                            class="w-full inline-flex justify-center rounded-md border border-transparent shadow-sm px-4 py-2 bg-blue-600 text-base font-medium text-white hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500 sm:ml-3 sm:w-auto sm:text-sm">
                        Confirm reservation
                    </button>
                    <button type="button"
                            class="mt-3 w-full inline-flex justify-center rounded-md border border-gray-300 shadow-sm px-4 py-2 bg-white text-base font-medium text-gray-700 hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500 sm:mt-0 sm:ml-3 sm:w-auto sm:text-sm">
                        Cancel
                    </button>
                </div>
            </div>
        </div>
    </div>

</div>

<script src="js/app.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.29.1/moment.min.js"></script>
<script>
    let vue = new Vue({
        el: '#app',
        data: {
            current_month: moment(new Date()).format("MMMM"),
            current_day: moment(new Date()).format("d"),
            current_day_name: moment(new Date()).format('dddd'),

            room: 'Reserve the room you want',

            is_training: false,
            is_repetitive: false,

            days_in_month: 0,
            show_modal: true,


        }, methods: {
            pickDay() {
                this.show_modal = !this.show_modal
            },
            daysInMonth() {
                let dt = new Date();
                let month = dt.getMonth() + 1;
                let year = dt.getFullYear();
                this.days_in_month = new Date(year, month, 0).getDate();
            },

            onChangeRoom() {
                if (this.room == 'Training room A' || this.room == 'Training room B' || this.room == 'Maker space training area') {
                    this.is_training = true
                } else if (this.room = 'Meeting room') {
                    this.is_training = false
                }
            }

        }, mounted() {
            this.daysInMonth()
        }
    })
</script>
</body>
</html>