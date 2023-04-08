import { Meta, StoryObj } from '@storybook/react';
import { FormButton } from '@/components';

const meta: Meta<typeof FormButton> = {
  title: 'FormButton',
  component: FormButton,
};

export default meta;
type Story = StoryObj<typeof FormButton>;

export const normal: Story = { args: { children: 'Press me' } };
export const loading: Story = { args: { children: 'Press me', isLoading: true } };
