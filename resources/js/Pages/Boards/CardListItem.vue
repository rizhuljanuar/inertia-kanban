<script setup>
import { PencilIcon } from "@heroicons/vue/solid";

const props = defineProps({
  card: Object,
});
</script>

<template>
  <li
    class="
      group
      relative
      bg-white
      p-3
      shadow
      rounded-md
      border-b border-gray-300
      hover:bg-gray-50
    "
  >
    <a href="#" class="text-sm">{{ card.title }}</a>
    <button
      class="
        hidden
        absolute
        top-1
        right-1
        w-8
        h-8
        bg-gray-50
        group-hover:grid
        place-content-center
        rounded-md
        text-gray-600
        hover:text-black hover:bg-gray-200
      "
    >
      <PencilIcon class="w-5 h-5" />
    </button>
  </li>
</template>