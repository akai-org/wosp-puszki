import { StoryObj } from '@storybook/react';
import { Sidebar } from '@/components/Layout/Sidebar/Sidebar';
import { StaticRouter } from 'react-router-dom/server';
import { FC } from 'react';

export default {
  title: 'Sidebar',
  component: Sidebar,
  decorators: [
    (Story: FC) => (
      <StaticRouter location={''}>
        <Story />
      </StaticRouter>
    ),
  ],
  args: {
    credentials: 'credentials',
  },
  argTypes: {
    credentials: {
      table: { disable: true },
    },
    deleteCredentials: {
      table: { disable: true },
    },
    toggleSidebar: {
      table: { disable: true },
    },
    links: {
      table: { disable: true },
    },
  },
};

type Story = StoryObj<typeof Sidebar>;

export const Admin: Story = {
  args: {
    links: [
      {
        label: 'Strona Główna',
        url: '',
        permission: 'volounteer',
      },
      {
        label: 'Przeliczone puszki',
        url: 'counted_boxes',
        permission: 'volounteer',
      },
      {
        label: 'Admin',
        url: 'admin',
        permission: 'volounteer',
      },
      {
        label: 'Puszki',
        url: 'boxes',
        permission: 'volounteer',
      },
    ],
    username: 'superadmin',
    show: true,
  },
};
export const User: Story = {
  args: {
    links: [
      {
        label: 'Strona Główna',
        url: '',
        permission: 'volounteer',
      },
      {
        label: 'Puszki',
        url: 'boxes',
        permission: 'volounteer',
      },
    ],
    username: 'User',
    show: true,
  },
};
export const NarrowAdmin: Story = {
  args: {
    links: [
      {
        label: 'Strona Główna',
        url: '',
        permission: 'volounteer',
      },
      {
        label: 'Przeliczone puszki',
        url: 'counted_boxes',
        permission: 'volounteer',
      },
      {
        label: 'Admin',
        url: 'admin',
        permission: 'volounteer',
      },
      {
        label: 'Puszki',
        url: 'boxes',
        permission: 'volounteer',
      },
    ],
    username: 'superadmin',
    show: false,
  },
};
