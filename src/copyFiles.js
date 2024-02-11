import fs from "fs";

// 源文件夹路径
const sourceDir = '../build';
// 目标文件夹路径
const targetDirs = 'public/build';

fs.existsSync(targetDirs) || fs.mkdirSync(targetDirs, { recursive: true });
fs.cpSync(sourceDir, targetDirs, { recursive: true });
console.log(`Folder copied from ${sourceDir} to ${targetDirs}`);
