<script setup lang="ts">
import { SidebarGroup, SidebarGroupLabel, SidebarMenu, SidebarMenuButton, SidebarMenuItem } from '@/components/ui/sidebar';
import { type NavItem } from '@/types';
import { Link, usePage } from '@inertiajs/vue3';
import Collapsible from '@/components/ui/collapsible/Collapsible.vue';
import CollapsibleTrigger from '@/components/ui/collapsible/CollapsibleTrigger.vue';
import CollapsibleContent from '@/components/ui/collapsible/CollapsibleContent.vue';
import { ChevronDown, House, Columns3, Building2, Building, BrickWall, BookText, Contact , Users, BookUser } from 'lucide-vue-next';


defineProps<{
    items: NavItem[];
}>();

const page = usePage();
</script>

<template>
    <SidebarGroup class="px-2 py-0">
        <SidebarGroupLabel>Platform</SidebarGroupLabel>


              <SidebarMenu>
            <SidebarMenuItem v-for="item in items" :key="item.title">
                <SidebarMenuButton as-child :is-active="item.href === page.url" :tooltip="item.title">
                    <Link :href="route(item.href)" class="flex items-center px-2 py-2 rounded-md hover:bg-gray-100 text-sidebar-foreground text-sm font-medium">
                        <component :is="item.icon" />
                        <span class="text-sm font-medium">{{ item.title }}</span>
                    </Link>
                </SidebarMenuButton>
            </SidebarMenuItem>
        </SidebarMenu>
        <SidebarMenu>
                <SidebarMenuItem>
                    <Collapsible defaultOpen class="group/collapsible">
                        <CollapsibleTrigger as="button" class="w-full flex items-center px-2 py-2 rounded-md hover:bg-gray-100 text-sidebar-foreground text-sm font-medium">
                          <House class="mr-2 h-4 w-4 text-sidebar-foreground"/>
                                <span class="flex-1 text-left">Properties</span>
                            <ChevronDown class="ml-auto transition-transform group-data-[state=open]/collapsible:rotate-180" />
                        </CollapsibleTrigger>
                        <CollapsibleContent>
                            <ul class="pl-7 py-2 space-y-1">
                                <li>
                                    <Link :href="route('admin.developer.index')" class="flex items-center px-2 py-1 rounded hover:bg-gray-100 text-sm font-medium">
                                      <Building2 class="mr-2 h-4 w-4 text-sidebar-foreground"/>   Developer
                                    </Link>
                                </li>
                                <li>
                                    <Link :href="route('admin.project.index')" class="flex items-center px-2 py-1 rounded hover:bg-gray-100 text-sm font-medium">
                                       <Building class="mr-2 h-4 w-4 text-sidebar-foreground"/>  Project
                                    </Link>
                                </li>
                                <li>
                                    <Link :href="route('admin.property-units.index')" class="flex items-center px-2 py-1 rounded hover:bg-gray-100 text-sm font-medium">
                                      <BrickWall class="mr-2 h-4 w-4 text-sidebar-foreground"/>   Unit
                                    </Link>
                                </li>
                            </ul>
                        </CollapsibleContent>
                    </Collapsible>
                </SidebarMenuItem>
            </SidebarMenu>
            <SidebarMenu>
                <SidebarMenuItem>
                    <Collapsible defaultOpen class="group/collapsible">
                        <CollapsibleTrigger as="button" class="w-full flex items-center px-2 py-2 rounded-md hover:bg-gray-100 text-sidebar-foreground text-sm font-medium">
                          <Columns3 class="mr-2 h-4 w-4 text-sidebar-foreground"/>
                                    <span class="flex-1 text-left">Pages</span>
                            <ChevronDown class="ml-auto transition-transform group-data-[state=open]/collapsible:rotate-180" />
                        </CollapsibleTrigger>
                        <CollapsibleContent>
                            <ul class="pl-7 py-2 space-y-1">
                                <li>
                                    <Link :href="route('admin.heroes.edit' , 1)" class="flex items-center px-2 py-1 rounded hover:bg-gray-100 text-sm font-medium">
                                     <BookText class="mr-2 h-4 w-4 text-sidebar-foreground"/>  Hero
                                    </Link>
                                </li>
                                <li>
                                    <Link :href="route('admin.about-us.edit' , 1)" class="flex items-center px-2 py-1 rounded hover:bg-gray-100 text-sm font-medium">
                                      <BookUser class="mr-2 h-4 w-4 text-sidebar-foreground"/>   About Us
                                    </Link>
                                </li>
                                <li>
                                    <Link :href="route('admin.our-team.index')" class="flex items-center px-2 py-1 rounded hover:bg-gray-100 text-sm font-medium">
                                       <Users class="mr-2 h-4 w-4 text-sidebar-foreground"/>   Our Team
                                    </Link>
                                </li>
                                <li>
                                    <Link :href="route('admin.contact-us.edit' , 1)" class="flex items-center px-2 py-1 rounded hover:bg-gray-100 text-sm font-medium">
                                       <Contact class="mr-2 h-4 w-4 text-sidebar-foreground"/>   Contacts
                                    </Link>
                                </li>
                            </ul>
                        </CollapsibleContent>
                    </Collapsible>
                </SidebarMenuItem>
            </SidebarMenu>



    </SidebarGroup>
</template>
