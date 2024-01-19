// vite.config.ts
import { defineConfig } from "file:///D:/Coding/wosp-puszki/client/node_modules/vite/dist/node/index.js";
import react from "file:///D:/Coding/wosp-puszki/client/node_modules/@vitejs/plugin-react/dist/index.mjs";
import vitePluginImp from "file:///D:/Coding/wosp-puszki/client/node_modules/vite-plugin-imp/dist/index.mjs";
import path from "path";
import svgr from "file:///D:/Coding/wosp-puszki/client/node_modules/vite-plugin-svgr/dist/index.mjs";
var __vite_injected_original_dirname = "D:\\Coding\\wosp-puszki\\client";
var vite_config_default = defineConfig({
  base: "/system/",
  plugins: [
    svgr(),
    react(),
    vitePluginImp({
      libList: [
        {
          libName: "antd",
          style: (name) => `antd/es/${name}/style`
        }
      ]
    })
  ],
  test: { globals: true, environment: "jsdom", setupFiles: "./tests/setup.ts" },
  resolve: {
    alias: [
      { find: "less", replacement: path.resolve(__vite_injected_original_dirname, "./src/less/") },
      { find: "@components", replacement: path.resolve(__vite_injected_original_dirname, "./src/components/") },
      { find: "@utils", replacement: path.resolve(__vite_injected_original_dirname, "./src/utils/") },
      { find: "@assets", replacement: path.resolve(__vite_injected_original_dirname, "./src/assets/") },
      { find: "@pages", replacement: path.resolve(__vite_injected_original_dirname, "./src/pages/") },
      { find: "@tests", replacement: path.resolve(__vite_injected_original_dirname, "./tests/") },
      { find: "@", replacement: path.resolve(__vite_injected_original_dirname, "./src/") }
    ]
  },
  css: {
    preprocessorOptions: {
      less: {
        modifyVars: {
          "primary-color": "#CF1322",
          "btn-primary-bg": "#CF1322",
          "font-size-base": "16px",
          "font-size-lg": "24px",
          "heading-1-size": "40px",
          "heading-2-size": "32px",
          "text-color-secondary": "#CF1322"
        },
        javascriptEnabled: true
      }
    }
  }
});
export {
  vite_config_default as default
};
//# sourceMappingURL=data:application/json;base64,ewogICJ2ZXJzaW9uIjogMywKICAic291cmNlcyI6IFsidml0ZS5jb25maWcudHMiXSwKICAic291cmNlc0NvbnRlbnQiOiBbImNvbnN0IF9fdml0ZV9pbmplY3RlZF9vcmlnaW5hbF9kaXJuYW1lID0gXCJEOlxcXFxDb2RpbmdcXFxcd29zcC1wdXN6a2lcXFxcY2xpZW50XCI7Y29uc3QgX192aXRlX2luamVjdGVkX29yaWdpbmFsX2ZpbGVuYW1lID0gXCJEOlxcXFxDb2RpbmdcXFxcd29zcC1wdXN6a2lcXFxcY2xpZW50XFxcXHZpdGUuY29uZmlnLnRzXCI7Y29uc3QgX192aXRlX2luamVjdGVkX29yaWdpbmFsX2ltcG9ydF9tZXRhX3VybCA9IFwiZmlsZTovLy9EOi9Db2Rpbmcvd29zcC1wdXN6a2kvY2xpZW50L3ZpdGUuY29uZmlnLnRzXCI7LyoqIEB0eXBlIHtpbXBvcnQoJ3ZpdGUnKS5Vc2VyQ29uZmlnfSAqL1xyXG5pbXBvcnQgeyBkZWZpbmVDb25maWcsIFVzZXJDb25maWcgfSBmcm9tICd2aXRlJztcclxuaW1wb3J0IHJlYWN0IGZyb20gJ0B2aXRlanMvcGx1Z2luLXJlYWN0JztcclxuaW1wb3J0IHZpdGVQbHVnaW5JbXAgZnJvbSAndml0ZS1wbHVnaW4taW1wJztcclxuaW1wb3J0IHBhdGggZnJvbSAncGF0aCc7XHJcbmltcG9ydCBzdmdyIGZyb20gJ3ZpdGUtcGx1Z2luLXN2Z3InO1xyXG5pbXBvcnQgeyBJbmxpbmVDb25maWcgfSBmcm9tICd2aXRlc3QnO1xyXG5cclxuaW50ZXJmYWNlIFZpdGVzdENvbmZpZ0V4cG9ydCBleHRlbmRzIFVzZXJDb25maWcge1xyXG4gIHRlc3Q6IElubGluZUNvbmZpZztcclxufVxyXG5cclxuZXhwb3J0IGRlZmF1bHQgZGVmaW5lQ29uZmlnKHtcclxuICBiYXNlOiAnL3N5c3RlbS8nLFxyXG4gIHBsdWdpbnM6IFtcclxuICAgIHN2Z3IoKSxcclxuICAgIHJlYWN0KCksXHJcbiAgICB2aXRlUGx1Z2luSW1wKHtcclxuICAgICAgbGliTGlzdDogW1xyXG4gICAgICAgIHtcclxuICAgICAgICAgIGxpYk5hbWU6ICdhbnRkJyxcclxuICAgICAgICAgIHN0eWxlOiAobmFtZSkgPT4gYGFudGQvZXMvJHtuYW1lfS9zdHlsZWAsXHJcbiAgICAgICAgfSxcclxuICAgICAgXSxcclxuICAgIH0pLFxyXG4gIF0sXHJcbiAgdGVzdDogeyBnbG9iYWxzOiB0cnVlLCBlbnZpcm9ubWVudDogJ2pzZG9tJywgc2V0dXBGaWxlczogJy4vdGVzdHMvc2V0dXAudHMnIH0sXHJcbiAgcmVzb2x2ZToge1xyXG4gICAgYWxpYXM6IFtcclxuICAgICAgeyBmaW5kOiAnbGVzcycsIHJlcGxhY2VtZW50OiBwYXRoLnJlc29sdmUoX19kaXJuYW1lLCAnLi9zcmMvbGVzcy8nKSB9LFxyXG4gICAgICB7IGZpbmQ6ICdAY29tcG9uZW50cycsIHJlcGxhY2VtZW50OiBwYXRoLnJlc29sdmUoX19kaXJuYW1lLCAnLi9zcmMvY29tcG9uZW50cy8nKSB9LFxyXG4gICAgICB7IGZpbmQ6ICdAdXRpbHMnLCByZXBsYWNlbWVudDogcGF0aC5yZXNvbHZlKF9fZGlybmFtZSwgJy4vc3JjL3V0aWxzLycpIH0sXHJcbiAgICAgIHsgZmluZDogJ0Bhc3NldHMnLCByZXBsYWNlbWVudDogcGF0aC5yZXNvbHZlKF9fZGlybmFtZSwgJy4vc3JjL2Fzc2V0cy8nKSB9LFxyXG4gICAgICB7IGZpbmQ6ICdAcGFnZXMnLCByZXBsYWNlbWVudDogcGF0aC5yZXNvbHZlKF9fZGlybmFtZSwgJy4vc3JjL3BhZ2VzLycpIH0sXHJcbiAgICAgIHsgZmluZDogJ0B0ZXN0cycsIHJlcGxhY2VtZW50OiBwYXRoLnJlc29sdmUoX19kaXJuYW1lLCAnLi90ZXN0cy8nKSB9LFxyXG4gICAgICB7IGZpbmQ6ICdAJywgcmVwbGFjZW1lbnQ6IHBhdGgucmVzb2x2ZShfX2Rpcm5hbWUsICcuL3NyYy8nKSB9LFxyXG4gICAgXSxcclxuICB9LFxyXG4gIGNzczoge1xyXG4gICAgcHJlcHJvY2Vzc29yT3B0aW9uczoge1xyXG4gICAgICBsZXNzOiB7XHJcbiAgICAgICAgbW9kaWZ5VmFyczoge1xyXG4gICAgICAgICAgJ3ByaW1hcnktY29sb3InOiAnI0NGMTMyMicsXHJcbiAgICAgICAgICAnYnRuLXByaW1hcnktYmcnOiAnI0NGMTMyMicsXHJcbiAgICAgICAgICAvL2ZvbnRzXHJcbiAgICAgICAgICAnZm9udC1zaXplLWJhc2UnOiAnMTZweCcsXHJcbiAgICAgICAgICAnZm9udC1zaXplLWxnJzogJzI0cHgnLFxyXG4gICAgICAgICAgJ2hlYWRpbmctMS1zaXplJzogJzQwcHgnLFxyXG4gICAgICAgICAgJ2hlYWRpbmctMi1zaXplJzogJzMycHgnLFxyXG4gICAgICAgICAgJ3RleHQtY29sb3Itc2Vjb25kYXJ5JzogJyNDRjEzMjInLFxyXG4gICAgICAgIH0sXHJcblxyXG4gICAgICAgIGphdmFzY3JpcHRFbmFibGVkOiB0cnVlLFxyXG4gICAgICB9LFxyXG4gICAgfSxcclxuICB9LFxyXG59IGFzIFZpdGVzdENvbmZpZ0V4cG9ydCk7XHJcbiJdLAogICJtYXBwaW5ncyI6ICI7QUFDQSxTQUFTLG9CQUFnQztBQUN6QyxPQUFPLFdBQVc7QUFDbEIsT0FBTyxtQkFBbUI7QUFDMUIsT0FBTyxVQUFVO0FBQ2pCLE9BQU8sVUFBVTtBQUxqQixJQUFNLG1DQUFtQztBQVl6QyxJQUFPLHNCQUFRLGFBQWE7QUFBQSxFQUMxQixNQUFNO0FBQUEsRUFDTixTQUFTO0FBQUEsSUFDUCxLQUFLO0FBQUEsSUFDTCxNQUFNO0FBQUEsSUFDTixjQUFjO0FBQUEsTUFDWixTQUFTO0FBQUEsUUFDUDtBQUFBLFVBQ0UsU0FBUztBQUFBLFVBQ1QsT0FBTyxDQUFDLFNBQVMsV0FBVztBQUFBLFFBQzlCO0FBQUEsTUFDRjtBQUFBLElBQ0YsQ0FBQztBQUFBLEVBQ0g7QUFBQSxFQUNBLE1BQU0sRUFBRSxTQUFTLE1BQU0sYUFBYSxTQUFTLFlBQVksbUJBQW1CO0FBQUEsRUFDNUUsU0FBUztBQUFBLElBQ1AsT0FBTztBQUFBLE1BQ0wsRUFBRSxNQUFNLFFBQVEsYUFBYSxLQUFLLFFBQVEsa0NBQVcsYUFBYSxFQUFFO0FBQUEsTUFDcEUsRUFBRSxNQUFNLGVBQWUsYUFBYSxLQUFLLFFBQVEsa0NBQVcsbUJBQW1CLEVBQUU7QUFBQSxNQUNqRixFQUFFLE1BQU0sVUFBVSxhQUFhLEtBQUssUUFBUSxrQ0FBVyxjQUFjLEVBQUU7QUFBQSxNQUN2RSxFQUFFLE1BQU0sV0FBVyxhQUFhLEtBQUssUUFBUSxrQ0FBVyxlQUFlLEVBQUU7QUFBQSxNQUN6RSxFQUFFLE1BQU0sVUFBVSxhQUFhLEtBQUssUUFBUSxrQ0FBVyxjQUFjLEVBQUU7QUFBQSxNQUN2RSxFQUFFLE1BQU0sVUFBVSxhQUFhLEtBQUssUUFBUSxrQ0FBVyxVQUFVLEVBQUU7QUFBQSxNQUNuRSxFQUFFLE1BQU0sS0FBSyxhQUFhLEtBQUssUUFBUSxrQ0FBVyxRQUFRLEVBQUU7QUFBQSxJQUM5RDtBQUFBLEVBQ0Y7QUFBQSxFQUNBLEtBQUs7QUFBQSxJQUNILHFCQUFxQjtBQUFBLE1BQ25CLE1BQU07QUFBQSxRQUNKLFlBQVk7QUFBQSxVQUNWLGlCQUFpQjtBQUFBLFVBQ2pCLGtCQUFrQjtBQUFBLFVBRWxCLGtCQUFrQjtBQUFBLFVBQ2xCLGdCQUFnQjtBQUFBLFVBQ2hCLGtCQUFrQjtBQUFBLFVBQ2xCLGtCQUFrQjtBQUFBLFVBQ2xCLHdCQUF3QjtBQUFBLFFBQzFCO0FBQUEsUUFFQSxtQkFBbUI7QUFBQSxNQUNyQjtBQUFBLElBQ0Y7QUFBQSxFQUNGO0FBQ0YsQ0FBdUI7IiwKICAibmFtZXMiOiBbXQp9Cg==
