<script setup>
import { useForm } from "@inertiajs/inertia-vue3";
import { ref } from "@vue/reactivity";
import { nextTick, watch } from "@vue/runtime-core";

const props = defineProps({
  board: Object,
});

const form = useForm({
  name: props.board.name,
});

const heading = ref();
const input = ref();

const isEditing = ref(false);

function resize() {
  input.value.style.width = `${heading.value.offsetWidth + 2}px`;
}

watch(
  () => form.name,
  async () => {
    await nextTick();
    resize();
  }
);

async function edit() {
  isEditing.value = true;
  await nextTick();
  input.value.select();
  resize();
}

function onSubmit() {
  isEditing.value = false;

  form.put(route("boards.update", { board: props.board.id }), {
    onError: () => form.reset(),
  });
}
</script>

<template>
  <div class="flex flex-col items-start max-w-full">
    <h1
      @click="edit()"
      :class="[isEditing ? 'absolute -left-[1000rem]' : '']"
      ref="heading"
      class="
        hover:bg-white/20
        whitespace-pre-wrap
        break-all
        rounded-md
        border border-transparent
        cursor-pointer
        px-3
        py-1.5
        text-2xl text-white
        font-bold
      "
    >
      {{ form.name ? form.name : " " }}
    </h1>
    <form
      v-show="isEditing"
      @focusout="onSubmit"
      @submit.prevent="onSubmit"
      class="w-full"
    >
      <input
        ref="input"
        v-model="form.name"
        type="text"
        class="
          text-2xl
          max-w-full
          form-bold
          placeholder-gray-400
          px-3
          py-1.5
          rounded-md
          focus:ring-2 focus:ring-blue-900
        "
        placeholder="Border name"
      />
    </form>
  </div>
</template>