/** @type {import('vite').UserConfig} */
import { defineConfig } from 'vite';
import react from '@vitejs/plugin-react';
import vitePluginImp from 'vite-plugin-imp';

export default defineConfig({
  plugins: [
    react(),
    vitePluginImp({
      libList: [
        {
          libName: 'antd',
          style: (name) => `antd/es/${name}/style`,
        },
      ],
    }),
  ],
  resolve: {
    alias: [{ find: 'less', replacement: '/src/less' }],
  },
  css: {
    preprocessorOptions: {
      less: {
        modifyVars: {
          'btn-primary-bg': '#CF1322',
          //fonts
          'font-size-base': '16px',
          'font-size-lg': '24px',
          'heading-1-size': '40px',
          'heading-2-size': '32px',
        },

        javascriptEnabled: true,
      },
    },
  },
});
