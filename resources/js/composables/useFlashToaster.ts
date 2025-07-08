import { usePage } from '@inertiajs/vue3';
import { watch } from 'vue';
import { toast } from 'vue-sonner';

export function useFlashToaster() {
  const page = usePage();
  watch(
    () => page.props.flash && page.props.flash.success,
    (val) => {
      if (val) {
        toast('Success', {
          description: val,
        });
        page.props.flash.success = null;
      }
    }
  );
}
