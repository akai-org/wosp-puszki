import { StoryObj } from '@storybook/react';
import { Navbar } from '@/components/Layout/Navbar/Navbar';
import { FC } from 'react';
import { StaticRouter } from 'react-router-dom/server';

export default {
  title: 'Navbar',
  component: Navbar,
  decorators: [
    (Story: FC) => (
      <StaticRouter location={''}>
        <Story />
      </StaticRouter>
    ),
  ],
  argTypes: {
    links: {
      table: { disable: true },
    },
  },
};
type Story = StoryObj<typeof Navbar>;

export const CountedBoxesNav: Story = {
  args: {
    links: [
      {
        label: 'Lista puszek',
        url: 'countedBoxes',
      },
    ],
  },
};

export const AdminPanelNav: Story = {
  args: {
    links: [
      {
        label: 'Dodaj użytkownika',
        url: 'admin/users/add',
      },
      {
        label: 'Lista użytkowników',
        url: 'admin',
        withDot: true,
      },
      {
        label: 'Dodaj wolontariusza',
        url: 'admin/volunteers/add',
        show: true,
      },
      {
        label: 'Lista wolontariuszy',
        url: 'admin/volunteers/list',
        withDot: true,
      },
      {
        label: 'Logi',
        url: 'admin/logs',
      },
    ],
  },
};

export const GiveOrSettleBoxNav: Story = {
  args: {
    links: [
      {
        label: 'Wydaj puszkę',
        url: 'boxes',
      },
      {
        label: 'Rozlicz puszkę',
        url: 'boxes/settle',
      },
    ],
  },
};
