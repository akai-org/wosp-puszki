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
};

type Story = StoryObj<typeof Sidebar>;

export const Admin: Story = {
  args: {
    links: [
      {
        label: 'Strona Główna',
        url: '',
      },
      {
        label: 'Przeliczone puszki',
        url: 'counted_boxes',
      },
      {
        label: 'Admin',
        url: 'admin',
      },
      {
        label: 'Puszki',
        url: 'boxes',
      },
    ],
    username: 'superadmin',
    show: true,
    credentials: 'testCredentials',
  },
};
export const User: Story = {
  args: {
    links: [
      {
        label: 'Strona Główna',
        url: '',
      },
      {
        label: 'Puszki',
        url: 'boxes',
      },
    ],
    username: 'User',
    show: true,
    credentials: 'testCredentials',
  },
};
