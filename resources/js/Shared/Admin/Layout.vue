<script setup>
import { computed, ref, onMounted } from 'vue'
import { Input } from '@/components/ui/input'
import { ResizableHandle, ResizablePanel, ResizablePanelGroup } from '@/components/ui/resizable'
import { Separator } from '@/components/ui/separator'
import {
    Tabs,
    TabsContent,
    TabsList,
    TabsTrigger,
} from '@/components/ui/tabs'
import { TooltipProvider } from '@/components/ui/tooltip'
import { Button } from "@/components/ui/button"
import {
    DropdownMenu,
    DropdownMenuItem,
    DropdownMenuContent,
    DropdownMenuLabel,
    DropdownMenuSeparator,
    DropdownMenuTrigger,
} from '@/components/ui/dropdown-menu'
import { SunMoon } from 'lucide-vue-next'
import { Sun } from 'lucide-vue-next'
import { cn } from '@/lib/utils'
import { refDebounced } from '@vueuse/core'
import {
    Search,
} from 'lucide-vue-next'
import { PanelsTopLeft } from 'lucide-vue-next'
import { CircleUser } from 'lucide-vue-next'
import { Badge } from '@/components/ui/badge'
import { formatDistanceToNow } from 'date-fns'
import Nav from './Nav.vue'
import {usePage} from "@inertiajs/vue3";

const props = defineProps({
    mails: {
        type: Array,
        default: () => []
    },
    defaultCollapsed: {
        type: Boolean,
        default: false
    },
    defaultLayout: {
        type: Function,
        default: () => [265, 440, 655]
    },
    navCollapsedSize: Number,
    accounts: Object
})

const page = usePage()

const auth = computed(() => page.props.auth.user)

const isCollapsed = ref(props.defaultCollapsed)
const searchValue = ref('')

const links2 = [
    {
        title: 'Users',
        icon: 'lucide:circle-user',
        variant: 'default',
    },
    {
        title: 'Roles',
        icon: 'lucide:user-cog',
        variant: 'ghost',
    },
    {
        title: 'Permissions',
        label: '',
        icon: 'lucide:user-cog',
        variant: 'ghost',
    },
]

function onCollapse() {
    isCollapsed.value = true
}

function onExpand() {
    isCollapsed.value = false
}// Apply the dark class if dark mode is enabled

function toggleSideBar() {
    isCollapsed.value = !isCollapsed.value
}

// Check if the user has a preference in localStorage
const isDarkMode = ref(false)

const checkDarkMode = () => {
    if(! localStorage.getItem('theme')) {
        localStorage.setItem('theme', 'light')
    }

    isDarkMode.value = localStorage.getItem('theme') === 'dark';
    if (isDarkMode.value) {
        document.documentElement.classList.add('dark');
    } else {
        document.documentElement.classList.remove('dark');
    }
};

onMounted(() => {
    checkDarkMode()
});

// Toggling dark mode manually
function toggleDarkMode() {
    const html = document.documentElement;
    isDarkMode.value = !isDarkMode.value
    html.classList.toggle('dark');
    const theme = html.classList.contains('dark') ? 'dark' : 'light';
    localStorage.setItem('theme', theme); // Save the user's preference
}

// document.documentElement.classList.add('dark');
</script>

<template>
    <TooltipProvider :delay-duration="0">
        <ResizablePanelGroup
            id="resize-panel-group-1"
            direction="horizontal"
            class="h-full max-h-[800px] items-stretch"
            :class="cn(isCollapsed && 'min-w-[50px] transition-all duration-300 ease-in-out')"
        >
            <ResizablePanel
                id="resize-panel-1"
                :default-size="defaultLayout[0]"
                :collapsed-size="navCollapsedSize"
                collapsible
                :min-size="15"
                :max-size="20"
                @expand="onExpand"
                @collapse="onCollapse"
            >
                <div class="h-[52px] flex items-center px-3">
                    <div class="uppercase font-bold">My sys</div>
                </div>
                <Separator />
                <Nav
                    :is-collapsed="isCollapsed"
                    :links="links2"
                />
            </ResizablePanel>
            <ResizableHandle id="resize-handle-1" />
            <ResizablePanel id="resize-panel-2"
                :default-size="defaultLayout[1]"
                :min-size="isCollapsed ? 100 : 30"
                :class="cn(isCollapsed && 'min-w-[50px] transition-all duration-300 ease-in-out')"
            >
                <div class="flex justify-between items-center px-2 py-[6px]">
                    <Button
                        @click="toggleSideBar"
                        variant="ghost" class="text-slate-500" size="icon">
                        <PanelsTopLeft />
                    </Button>

                    <div class="flex space-x-2">
                        <Button
                            @click="toggleDarkMode"
                            variant="ghost"
                            class="text-slate-500"
                            size="icon"
                        >
                            <Sun v-if="isDarkMode" />
                            <SunMoon  v-else />
                        </Button>

                        <DropdownMenu>
                            <DropdownMenuTrigger as-child>
                                <Button variant="ghost" class="text-slate-500" size="icon">
                                    <CircleUser />
                                </Button>
                            </DropdownMenuTrigger>

                            <DropdownMenuContent class="w-56">
                                <DropdownMenuLabel>{{ auth.name }}</DropdownMenuLabel>
                                <DropdownMenuSeparator />
                                <DropdownMenuItem
                                >
                                    Edit Profile
                                </DropdownMenuItem>
                                <DropdownMenuItem
                                >
                                    <Link :href="route('admin.logout')" method="post" as="button" type="button">
                                        Logout
                                    </Link>
                                </DropdownMenuItem>
                            </DropdownMenuContent>
                        </DropdownMenu>
                    </div>
                </div>
                <Separator />
                <slot />
            </ResizablePanel>
        </ResizablePanelGroup>
    </TooltipProvider>
</template>
