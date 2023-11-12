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
        label: 'Lista puszek do zatwierdzenia',
        url: 'countedBoxes',
        show: true,
      },
      {
        label: 'Lista puszek zatwierdzonych',
        url: 'countedBoxes/approved',
        show: true,
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
        show: true,
      },
      {
        label: 'Lista użytkowników',
        url: 'admin',
        show: true,
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
        show: true,
        withDot: true,
      },
      {
        label: 'Logi',
        url: 'admin/logs',
        show: true,
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
        show: true,
      },
      {
        label: 'Rozlicz puszkę',
        url: 'boxes/settle',
        show: true,
      },
    ],
  },
};
