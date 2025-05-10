@extends('layouts.main')

@section('main')
<main class="min-h-screen bg-gradient-to-br from-gray-50 to-blue-100 py-16">
  <div class="container mx-auto px-6">
    <div class="bg-white shadow-2xl rounded-3xl overflow-hidden grid md:grid-cols-3 transition-all duration-500 hover:shadow-3xl">

      <!-- Left Side Hero -->
      <div class="bg-gradient-to-br from-blue-600 to-indigo-700 text-white p-10 flex flex-col justify-between md:col-span-1">
        <div>
          <h1 class="text-4xl font-bold mb-6 leading-tight animate-fade-in-down">Join IUTCS</h1>
          <div class="relative h-2 bg-blue-400 rounded-full mb-6 overflow-hidden">
            <div id="progress-bar" class="h-full bg-blue-300 transition-all duration-500 ease-out"></div>
          </div>
          <p class="text-lg opacity-90">Start your tech journey with us and connect with passionate innovators.</p>
        </div>
        <div class="hidden md:block mt-10 animate-slide-in-left">
          <blockquote class="border-l-4 border-blue-300 pl-4 italic text-blue-100">
            "IUTCS opened countless opportunities for my career growth in technology."
            <footer class="mt-2 font-semibold">— IUT Alumni</footer>
          </blockquote>
        </div>
      </div>

      <!-- Right Side Form -->
      <div class="md:col-span-2 p-10">
        <form action="/signup" method="POST" class="space-y-8" id="registration-form">
          @csrf
          @if($errors->any())
            <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded animate-shake">
              <strong class="font-bold">Whoops!</strong>
              <ul class="mt-2 list-disc pl-5">
                @foreach ($errors->all() as $error)
                  <li>{{ $error }}</li>
                @endforeach
              </ul>
            </div>
          @endif

            <!-- Step 1: Personal Info -->
            <div class="step transition-transform duration-300 ease-in-out" data-step="1">
              <div class="grid md:grid-cols-2 gap-6">
              <div class="animate-fade-in-right">
                <label class="block text-sm font-semibold text-gray-700 mb-2">
                Full Name <span class="text-red-500">*</span>
                </label>
                <input type="text" name="name" required value="{{ old('name') }}"
                class="w-full py-3 px-4 bg-gray-50 border-2 border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500 shadow-sm transition duration-300 hover:border-blue-400">
              </div>
              <div class="animate-fade-in-right delay-100">
                <label class="block text-sm font-semibold text-gray-700 mb-2">
                Student ID <span class="text-red-500">*</span>
                </label>
                <input type="text" name="studentID" required value="{{ old('studentID') }}"
                class="w-full py-3 px-4 bg-gray-50 border-2 border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500 shadow-sm transition duration-300 hover:border-blue-400">
              </div>
              </div>

              <div class="grid md:grid-cols-3 gap-6 mt-8">
              <div class="animate-fade-in-right delay-200">
                <label class="block text-sm font-semibold text-gray-700 mb-2">
                Email <span class="text-red-500">*</span>
                </label>
                <input type="email" name="email" required value="{{ old('email') }}"
                class="w-full py-3 px-4 bg-gray-50 border-2 border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500 shadow-sm transition duration-300 hover:border-blue-400">
              </div>
              <div class="animate-fade-in-right delay-300">
                <label class="block text-sm font-semibold text-gray-700 mb-2">
                Phone <span class="text-red-500">*</span>
                </label>
                <input type="tel" name="phone" required value="{{ old('phone') }}"
                class="w-full py-3 px-4 bg-gray-50 border-2 border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500 shadow-sm transition duration-300 hover:border-blue-400">
              </div>
              <div class="animate-fade-in-right delay-400">
                <label class="block text-sm font-semibold text-gray-700 mb-2">
                Gender <span class="text-red-500">*</span>
                </label>
                <select name="gender" required
                class="w-full py-3 px-4 bg-gray-50 border-2 border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500 shadow-sm transition duration-300 hover:border-blue-400 appearance-none bg-no-repeat bg-right pr-10"
                style="background-image: url('data:image/svg+xml;charset=US-ASCII,<svg width=\"20\" height=\"20\" xmlns=\"http://www.w3.org/2000/svg\"><path d=\"M7 10l5 5 5-5z\" fill=\"%234B5563\"/></svg>'); background-position: right 0.75rem center;">
                <option value="" {{ old('gender') == '' ? 'selected' : '' }} disabled>Select gender</option>
                <option value="boy" {{ old('gender') == 'boy' ? 'selected' : '' }}>Male</option>
                <option value="girl" {{ old('gender') == 'girl' ? 'selected' : '' }}>Female</option>
                </select>
              </div>
              </div>

              <div class="mt-8">
              <div class="animate-fade-in-up">
                <label class="block text-sm font-semibold text-gray-700 mb-2">
                Full Address <span class="text-red-500">*</span>
                </label>
                <input type="text" name="address" required value="{{ old('address') }}"
                class="w-full py-3 px-4 bg-gray-50 border-2 border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500 shadow-sm transition duration-300 hover:border-blue-400">
              </div>
              </div>
            </div>

          <!-- Step 2: Academic Info -->
          <div class="step hidden transition-transform duration-300 ease-in-out" data-step="2">
            <div class="grid md:grid-cols-2 gap-6">
              <div class="animate-fade-in-right">
                <label class="block text-sm font-semibold text-gray-700 mb-2">
                  University <span class="text-red-500">*</span>
                </label>
                <input type="text" name="university" required value="{{ old('university') }}"
                  class="w-full py-3 px-4 bg-gray-50 border-2 border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500 shadow-sm transition duration-300 hover:border-blue-400">
              </div>
              <div class="animate-fade-in-right delay-100">
                <label class="block text-sm font-semibold text-gray-700 mb-2">
                  Batch <span class="text-red-500">*</span>
                </label>
                <input type="text" name="batch" required value="{{ old('batch') }}"
                  class="w-full py-3 px-4 bg-gray-50 border-2 border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500 shadow-sm transition duration-300 hover:border-blue-400">
              </div>
            </div>

            <div class="mt-8 animate-fade-in-up">
              <label class="block text-sm font-semibold text-gray-700 mb-2">
                Short Bio <span class="text-red-500">*</span>
              </label>
              <textarea name="bio" rows="3" required
                class="w-full py-3 px-4 bg-gray-50 border-2 border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500 shadow-sm transition duration-300 hover:border-blue-400 resize-none">{{ old('bio') }}</textarea>
            </div>
          </div>

          <!-- Step 3: Social & Password -->
          <div class="step hidden transition-transform duration-300 ease-in-out" data-step="3">
            <div class="grid md:grid-cols-3 gap-6">
              <div class="animate-fade-in-right">
                <label class="block text-sm font-semibold text-gray-700 mb-2">
                  GitHub <span class="text-gray-400">(Optional)</span>
                </label>
                <input type="url" name="github" value="{{ old('github') }}"
                  class="w-full py-3 px-4 bg-gray-50 border-2 border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500 shadow-sm transition duration-300 hover:border-blue-400">
              </div>
              <div class="animate-fade-in-right delay-100">
                <label class="block text-sm font-semibold text-gray-700 mb-2">
                  LinkedIn <span class="text-gray-400">(Optional)</span>
                </label>
                <input type="url" name="linkedin" value="{{ old('linkedin') }}"
                  class="w-full py-3 px-4 bg-gray-50 border-2 border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500 shadow-sm transition duration-300 hover:border-blue-400">
              </div>
              <div class="animate-fade-in-right delay-200">
                <label class="block text-sm font-semibold text-gray-700 mb-2">
                  Portfolio <span class="text-gray-400">(Optional)</span>
                </label>
                <input type="url" name="website" value="{{ old('website') }}"
                  class="w-full py-3 px-4 bg-gray-50 border-2 border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500 shadow-sm transition duration-300 hover:border-blue-400">
              </div>
            </div>

            <div class="grid md:grid-cols-2 gap-6 mt-8">
              <div class="animate-fade-in-right">
                <label class="block text-sm font-semibold text-gray-700 mb-2">
                  Password <span class="text-red-500">*</span>
                </label>
                <input type="password" name="password" required
                  class="w-full py-3 px-4 bg-gray-50 border-2 border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500 shadow-sm transition duration-300 hover:border-blue-400">
              </div>
              <div class="animate-fade-in-right delay-100">
                <label class="block text-sm font-semibold text-gray-700 mb-2">
                  Confirm Password <span class="text-red-500">*</span>
                </label>
                <input type="password" name="password_confirmation" required
                  class="w-full py-3 px-4 bg-gray-50 border-2 border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500 shadow-sm transition duration-300 hover:border-blue-400">
              </div>
            </div>
          </div>

          <!-- Navigation Controls -->
          <div class="pt-4 flex justify-between items-center">
            <button type="button" id="prev-btn" class="hidden bg-gray-200 hover:bg-gray-300 text-gray-700 font-semibold py-3 px-8 rounded-lg transition duration-300 shadow-md transform hover:-translate-y-1">
              ← Previous
            </button>
            <button type="button" id="next-btn" class="ml-auto bg-blue-600 hover:bg-blue-700 text-white font-semibold py-3 px-8 rounded-lg transition duration-300 shadow-md transform hover:-translate-y-1">
              Next →
            </button>
            <button type="submit" id="submit-btn" class="hidden bg-green-600 hover:bg-green-700 text-white font-semibold py-3 px-8 rounded-lg transition duration-300 shadow-md transform hover:-translate-y-1">
              Submit
            </button>
          </div>

        </form>
      </div>
    </div>
  </div>
</main>

<style>
@keyframes fade-in-right {
  from { opacity: 0; transform: translateX(20px); }
  to { opacity: 1; transform: translateX(0); }
}

@keyframes fade-in-up {
  from { opacity: 0; transform: translateY(20px); }
  to { opacity: 1; transform: translateY(0); }
}

@keyframes shake {
  0%, 100% { transform: translateX(0); }
  25% { transform: translateX(-10px); }
  75% { transform: translateX(10px); }
}

.animate-fade-in-right {
  animation: fade-in-right 0.5s ease-out;
}

.animate-fade-in-up {
  animation: fade-in-up 0.5s ease-out;
}

.animate-shake {
  animation: shake 0.4s ease-in-out;
}

.delay-100 { animation-delay: 100ms; }
.delay-200 { animation-delay: 200ms; }
.delay-300 { animation-delay: 300ms; }
</style>

<script>
document.addEventListener('DOMContentLoaded', function() {
  const steps = document.querySelectorAll('.step');
  const prevBtn = document.getElementById('prev-btn');
  const nextBtn = document.getElementById('next-btn');
  const submitBtn = document.getElementById('submit-btn');
  const progressBar = document.getElementById('progress-bar');
  let currentStep = 1;

  function updateProgress() {
    const progress = ((currentStep - 1) / (steps.length - 1)) * 100;
    progressBar.style.width = `${progress}%`;
  }

  function showStep(step) {
    steps.forEach((s, index) => {
      s.classList.toggle('hidden', index + 1 !== step);
      s.style.transform = `translateX(${(step - (index + 1)) * 100}%)`;
    });

    prevBtn.classList.toggle('hidden', step === 1);
    nextBtn.classList.toggle('hidden', step === steps.length);
    submitBtn.classList.toggle('hidden', step !== steps.length);
    updateProgress();
  }

  nextBtn.addEventListener('click', function() {
    const currentStepElement = document.querySelector(`[data-step="${currentStep}"]`);
    const inputs = currentStepElement.querySelectorAll('input[required], textarea[required], select[required]');
    let isValid = true;

    inputs.forEach(input => {
      if (!input.value.trim()) {
        input.classList.add('border-red-500', 'shadow-red-200');
        isValid = false;
      } else {
        input.classList.remove('border-red-500', 'shadow-red-200');
      }
    });

    if (isValid && currentStep < steps.length) {
      currentStep++;
      showStep(currentStep);
    }
  });

  prevBtn.addEventListener('click', function() {
    if (currentStep > 1) {
      currentStep--;
      showStep(currentStep);
    }
  });

  // Initialize first step
  showStep(1);
});
</script>
@endsection