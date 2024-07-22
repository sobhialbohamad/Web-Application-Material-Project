

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
    <form method="POST" action="{{ route('login') }}">
        @csrf





        <!-- Email Address -->
        <div class="mt-4" style="    font-family: cursive;
    font-size: large;">
            <x-input-label for="email" :value="__('Email')" />
            <x-text-input id="email" class="block mt-1 w-full" type="email" name="email" :value="old('email')" required autocomplete="username"  style="border: 2px solid;
    padding-top: 5px;
    padding-bottom: 5px;
    border-style: groove;
    margin-bottom:20px;
    margin-left:20px;
    border-radius:25px;"/>
            <x-input-error :messages="$errors->get('email')" class="mt-2" />
        </div>

        <!-- Password -->
        <div class="mt-4"  style="    font-family: cursive;
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
          margin-left:20px;   border-radius:25px;"/>
            <x-input-error :messages="$errors->get('password')" class="mt-2" />
        </div>




        <div >


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
                {{ __('Login') }}
            </button>
        </div>
    </form>
</div>
