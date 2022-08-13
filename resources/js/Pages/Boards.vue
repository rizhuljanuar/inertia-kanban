<script setup>
import BreezeAuthenticatedLayout from "@/Layouts/Authenticated.vue";
import { Head, InertiaLink, useForm } from "@inertiajs/inertia-vue3";
import { PlusIcon } from "@heroicons/vue/solid";
import {
  Popover,
  PopoverButton,
  PopoverPanel,
  PopoverOverlay,
} from "@headlessui/vue";
import { ChevronDownIcon } from "@heroicons/vue/solid";

const props = defineProps({
  boards: Array,
});

const form = useForm({
  name: "",
});

function onSubmit(closePopever) {
  form.post(route("boards.store"), {
    onSuccess: () => {
      form.reset();
      closePopever();
    },
  });
}
</script>

<template>
  <Head title="Boards" />

  <BreezeAuthenticatedLayout>
    <div class="h-full bg-gray-50 px-4 py-6 overflow-y-auto">
      <div class="max-w-5xl mx-auto">
        <div class="px-3 flex items-center mb-4">
          <h3 class="font-black text-gray-700">My boards</h3>
          <Popover v-slot="{ open }" class="relative">
            <PopoverButton
              :class="open ? 'bg-blue-50 text-blue-600' : ''"
              class="
                inline-flex
                items-center
                ml-4
                py-2
                px-3
                bg-gray-100
                rounded
                font-medium
                hover:bg-gray-200
              "
            >
              <PlusIcon class="-ml-1 w-4 h-4" />
              <span class="ml-1">Create board</span>
            </PopoverButton>

            <PopoverOverlay class="z-10 fixed inset-0 bg-black opacity-30" />

            <transition
              enter-active-class="transition duration-200 ease-out"
              enter-from-class="translate-y-1 opacity-0"
              enter-to-class="translate-y-0 opacity-100"
              leave-active-class="transition duration-150 ease-in"
              leave-from-class="translate-y-0 opacity-100"
              leave-to-class="translate-y-1 opacity-0"
            >
              <PopoverPanel
                :focus="true"
                v-slot="{ close }"
                class="
                  absolute
                  left-1/2
                  z-10
                  mt-3
                  w-72
                  -translate-x-1/2
                  px-4
                  sm:px-0
                "
              >
                <div
                  class="
                    p-3
                    bg-white
                    overflow-hidden
                    rounded-lg
                    shadow-lg
                    ring-1 ring-black ring-opacity-5
                  "
                >
                  <form @submit.prevent="onSubmit(close)">
                    <label
                      for="name"
                      class="block text-sm text-gray-600 font-medium mb-1"
                      >Your name board</label
                    >
                    <input
                      v-model="form.name"
                      class="
                        block
                        w-full
                        text-sm
                        rounded-md
                        border-gray-300
                        shadow-sm
                        focus:border-blue-400 focus:ring-blue-400
                      "
                      type="text"
                      name="name"
                      id="name"
                      placeholder="Board name"
                    />
                    <p v-if="form.errors.name" class="text-sm text-red-600">
                      {{ form.errors.name }}
                    </p>
                    <div class="flex justify-end mt-2">
                      <button
                        class="
                          px-4
                          py-2
                          text-sm
                          font-medium
                          text-white
                          bg-rose-600
                          hover:bg-rose-500
                          rounded-md
                          shadow-sm
                          focus:ring-2
                          focus:ring-offset-2
                          focus:ring-rose-500
                          focus:outline-none
                        "
                      >
                        Create board
                      </button>
                    </div>
                  </form>
                </div>
              </PopoverPanel>
            </transition>
          </Popover>
        </div>

        <ul
          class="
            grid grid-cols-1
            gap-4
            sm:grid-cols-2
            md:grid-cols-3
            lg:grid-cols-4
          "
        >
          <li
            v-for="board in boards"
            :key="board.id"
            class="
              relative
              bg-blue-600
              hover:bg-blue-700
              rounded-md
              min-h-[7rem]
            "
          >
            <InertiaLink
              class="absolute inset-0 p-3 text-lg font-bold text-white"
              :href="route('boards.show', { board: board.id })"
            >
              {{ board.name }}
            </InertiaLink>
          </li>
        </ul>
      </div>
    </div>
  </BreezeAuthenticatedLayout>
</template>