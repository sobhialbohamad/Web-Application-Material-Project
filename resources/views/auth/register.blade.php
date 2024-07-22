

  <style>
     .flex-container {
         display: flex;
         align-items: center;
         justify-content: center;
     }

     .image-container {
         flex: 1;
         max-width: 50%; /* Adjust the width as needed */
     }

     .form-container {
         flex: 1;
         max-width: 50%; /* Adjust the width as needed */
         padding: 20px;
     }
 </style>
  <div class="flex-container">
    <!-- Image Container -->
    @if (isset($image))
    <div class="image-container">
        <img src="{{ $image }}" alt="Registration Image" style="width:100%;height:auto;">
    </div>
    @endif

     <div class="form-container">
    <form method="POST" action="{{ route('register') }}">
        @csrf


        <!-- Name -->
        <div>
            <x-input-label for="name" :value="__('Name')"  style="    font-family: cursive;
        font-size: large;"/>
            <x-text-input id="name"  type="text" name="name" :value="old('name')" required autofocus autocomplete="name" style="border: 2px solid;
    padding-top: 5px;
    padding-bottom: 5px;
    border-style: groove;
    margin-bottom:20px;
    margin-left:20px;
    border-radius:25px;"/>
            <x-input-error :messages="$errors->get('name')" class="mt-2" />
        </div>

        <!-- Email Address -->
        <div class="mt-4" style="    font-family: cursive;
    font-size: large;">
            <x-input-label for="email" :value="__('Email')" />
            <x-text-input id="email" class="block mt-1 w-full" type="email" name="email" :value="old('email')" required autocomplete="username" style="border: 2px solid;
    padding-top: 5px;
    padding-bottom: 5px;
    border-style: groove;
    margin-bottom:20px;
    margin-left:20px;
    border-radius:25px;"/>
            <x-input-error :messages="$errors->get('email')" class="mt-2" />
        </div>

        <!-- Password -->
        <div class="mt-4" style="    font-family: cursive;
    font-size: large;">
            <x-input-label for="password" :value="__('Password')" />
            <x-text-input id="password" class="block mt-1 w-full"
                type="password"
                name="password"
                required autocomplete="new-password" style="border: 2px solid;
        padding-top: 5px;
        padding-bottom: 5px;
        border-style: groove;
        margin-bottom:20px;
        margin-left:20px;
        border-radius:25px;"/>
            <x-input-error :messages="$errors->get('password')" class="mt-2" />
        </div>

        <!-- Confirm Password -->
        <div class="mt-4" style="    font-family: cursive;
    font-size: large;">
            <x-input-label for="password_confirmation" :value="__('Confirm Password')" />
            <x-text-input id="password_confirmation" class="block mt-1 w-full"
                type="password"
                name="password_confirmation" required autocomplete="new-password" style="border: 2px solid;
        padding-top: 5px;
        padding-bottom: 5px;
        border-style: groove;
        margin-bottom:20px;
        margin-left:20px;
        border-radius:25px;"/>
            <x-input-error :messages="$errors->get('password_confirmation')" class="mt-2" />
        </div>
        <div class="mt-4"  style="    font-family: cursive;
    font-size: large;
    margin-bottom: 20px;">
                   <label for="user_type" class="block text-sm font-medium text-gray-700">choose the group you want</label>
                   <select id="user_type" name="group_id" class="mt-1 block w-full py-2 px-3 border border-gray-300 bg-white rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm">
                       <option value="1">1</option>
                       <option value="2">2</option>
                   </select>
               </div>
        <!-- Register Button -->
        <div class="flex items-center justify-end mt-4">
            <a class="underline text-sm text-gray-600 dark:text-gray-400 hover:text-gray-900 dark:hover:text-gray-100 rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500 dark:focus:ring-offset-gray-800" href="{{ route('login') }}">
                {{ __('Already registered?') }}
            </a>
            <button  style="border: 0px solid;
    margin-left: 80px;
    font-size: 20px;
    font-family: cursive;
    background-color: #63FFF3;
    border-radius: 25px;
    padding-top: 10px;
    padding-bottom: 10px;
    padding-left: 46px;
    padding-right: 60px">
                {{ __('Register') }}
            </button>
        </div>
    </form>
</div>
