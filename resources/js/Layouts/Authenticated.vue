<script setup>
import { ref } from "vue";
import { Link } from "@inertiajs/inertia-vue3";
import { Menu, MenuButton, MenuItem, MenuItems } from "@headlessui/vue";
</script>

<template>
  <div>
    <div class="flex flex-col h-screen">
      <nav class="shrink-0 flex justify-between bg-white px-4 py-3 border-b">
        <a class="text-2xl font-black tracking-tight" :href="route('boards')"
          >kanboard</a
        >
        <div class="flex items-center">
          <a
            class="text-sm font-medium px-3 py-2 rounded-md hover:bg-gray-100"
            href="#"
            >My boards</a
          >
          <Menu as="div" class="ml-3 relative z-10">
            <MenuButton
              class="
                focus:outline-none
                focus:ring-2
                focus:ring-offset-2
                focus:ring-blue-400
                rounded-full
              "
            >
              <img
                class="h-9 w-9 inline rounded-full"
                :src="$page.props.auth.user.avatar_url"
                :alt="$page.props.auth.user.name"
              />
            </MenuButton>

            <transition
              enter-active-class="transition transform duration-100 ease-out"
              enter-from-class="opacity-0 scale-90"
              enter-to-class="opacity-100 scale-100"
              leave-active-class="transition transform duration-100 ease-in"
              leave-from-class="opacity-100 scale-100"
              leave-to-class="opacity-0 scale-90"
            >
              <MenuItems
                class="
                  origin-top-right
                  mt-2
                  focus:outline-none
                  absolute
                  right-0
                  bg-white
                  overflow-hidden
                  rounded-md
                  shadow-lg
                  border
                  w-48
                "
              >
                <MenuItem v-slot="{ active }">
                  <a
                    href="#"
                    :class="{ 'bg-gray-100': active }"
                    class="block px-4 py-2 text-sm text-gray-700"
                    >My Profile</a
                  >
                </MenuItem>
                <MenuItem v-slot="{ active }">
                  <Link
                    :href="route('logout')"
                    method="post"
                    as="button"
                    :class="{ 'bg-gray-100': active }"
                    class="block px-4 py-2 text-sm text-gray-700"
                    >Log out</Link
                  >
                </MenuItem>
              </MenuItems>
            </transition>
          </Menu>
        </div>
      </nav>

      <!-- Page Heading -->
      <header class="bg-white shadow" v-if="$slots.header">
        <div class="max-w-7xl mx-auto py-6 px-4 sm:px-6 lg:px-8">
          <slot name="header" />
        </div>
      </header>

      <!-- Page Content -->
      <main class="flex-1 overflow-hidden">
        <slot />
      </main>
    </div>
  </div>
</template>
