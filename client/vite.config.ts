import { defineConfig } from 'vite';
import react from '@vitejs/plugin-react';
import { getThemeVariables } from 'antd/dist/theme';
import vitePluginImp from 'vite-plugin-imp';
// https://vitejs.dev/config/
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
